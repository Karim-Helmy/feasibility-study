<?php
    /**
     * [aurl To Go To Admin Url]
     * @param  [string] $url [link]
     * @return [string]      [/admin.$url]
     */
    function aurl($url)
    {
        return url('/admin' . $url);
    }

    /**
     * [aurl To Go To Super Url]
     * @param  [string] $url [link]
     * @return [string]      [/super.$url]
     */
    function surl($url)
    {
        return url('/dashboard' . $url);
    }


    /**
     * [aurl To Go To Trainer Url]
     * @param  [string] $url [link]
     * @return [string]      [/trainer.$url]
     */
    function turl($url)
    {
        return url('/trainer' . $url);
    }

    /**
     * [aurl To Go To Student Url]
     * @param  [string] $url [link]
     * @return [string]      [/student.$url]
     */
    function sturl($url)
    {
        return url('/student' . $url);
    }

    /**
     * [UploadImages]
     * @param [folder] $dir   [FolderName]
     * @param [string] $image [Name Of The Image]
     */
    function UploadImages($dir, $image)
    {
        $saveImage = '';
        if (! File::exists(public_path('uploads').'/' . $dir)) { // if file or fiolder not exists
            /**
             *
             * @param $PATH Required
             * @param $mode Defualt 0775
             * @param create the directories recursively if doesn't exists
             */
            File::makeDirectory(public_path('uploads') . '/' . $dir, 0775, true); // create the dir or the
        }
        if (File::isFile($image)) {
            $name       = $image->getClientOriginalName(); // get image name
            $extension  = $image->getClientOriginalExtension(); // get image extension
            $sha1       = sha1($name); // hash the image name
            $fileName   = rand(1, 1000000) . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the image
            // get the image realpath
            $uploadedImage = Image::make($image->getRealPath());
            $uploadedImage->save(public_path('uploads/' . $dir . '/' . $fileName), '100'); // save the image
            $saveImage = $dir . '/' . $fileName; // get the name of the image and the dir that uploaded in
        }
        return $saveImage;
    }

    /**
     * [uploadMultiImages ]
     * @param  [type] $images   [Request Image]
     * @param  [type] $old      [Old Image]
     * @param  [type] $elImages [images in database]
     * @param  [type] $destination [Destination]
     * @return [type]           [Upload Multi Image]
     */
    function uploadMultiImages($images, $old, $elImages, $destination)
    {
        unlinkRemovedImages($old, $elImages);
        $imgs = [];
        if (!is_null($images)) {
            foreach ($images as $i) {
                $imgs[] = UploadImages($destination, $i);
            }
        }
        if(empty($old)){
            $old = [];
        }
        return implode('|', array_merge($old, $imgs));
    }


    /**
     * [UpdateImages]
     * @param [string] $oldFile [old image]
     * @param [folder] $dir     [folder of image]
     * @param [string] $image   [new image]
     */
    function UpdateImages($oldFile, $dir, $image) {
        if ( !empty($oldFile) && !is_null($oldFile) && file_exists( public_path('uploads/'.$oldFile) ) ) {
            unlink(public_path('uploads/'.$oldFile));
        }
        return UploadImages($dir, $image);
    }
    /**
     * [checkValue]
     * @param  [string] $value [Check if it Found Or No]
     * @return [Bollean]        [True Or False]
     */
    function checkValue($value)
    {
        return !empty($value) && !is_null($value);
    }

    /**
     * [unlinkRemovedImages]
     * @param  [type] $old      [description]
     * @param  [type] $elImages [description]
     * @return [type]           [description]
     */
    function unlinkRemovedImages($old, $elImages)
    {
        $elImages = explode('|', $elImages);

        $removedImages = array_diff($elImages, $old ?? []);

        if (count($removedImages) && !is_null($removedImages)) {
            foreach ($removedImages as $i) {
                if (!is_null($i) && !empty($i)) {
                    @unlink('uploads/'.$i);
                }
            }
        }
    }


    /**
     * [getUserIP]
     * @return [ip] [IP Address]
     */
    function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    /**
     * [GetSetting]
     * @param [type] $key [Get Value Of This Key]
     */
    function GetSetting($key) {
        try {
            $s = App\Setting::where('key', $key)->first();
            return $s->type != 'image' ? $s->value : asset('uploads/'.$s->value);
        } catch (\Exception $e) {
            throw new \Exception("Error In Settings $key Dose not exist", 1);

        }
    }


    /**
     * [Permission]
     * @param  [type] $permission [description]
     * @param  [type] $id         [description]
     * @return [type]             [description]
     */
    function userCan($permission, $id = null) {
        if (!is_null($id)) {
            $user = Admin::find($id);
        } else {
            $user = auth()->guard('webAdmin')->user();
        }
        if (checkValue($user->permissions)) {
            $role = $user->permissions->pluck('name')->toArray();
            $data = [$permission,'super.admin'];
            $result =  array_intersect($data,$role);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        return false;
    }


    /**
     * [Get Value Of Packages Options]
     * @param [type] $key [Get Value Of This Key]
     */
    function GetPackage($option_id,$package_id) {
        try {
            $package_option = App\PackageOption::where('option_id', $option_id)->where('package_id',$package_id)->first();
            return $package_option->value ?? "55555";
        } catch (\Exception $e) {
            throw new \Exception("Not exist", 1);

        }
    }



function namespacedXMLToArray($xml)
{
    // One function to both clean the XML string and return an array
    return json_decode(json_encode(simplexml_load_file(removeNamespaceFromXML($xml))), true);

}

if (!function_exists('responses'))
{
    function responses($status=null, $messages=null,$data=null)
    {



            return ['status' => $status, 'messages' => $messages, 'data' => $data];

    }
}

function limit_text($text, $limit) {
    $word_arr = explode(" ", $text);

    if (count($word_arr) > $limit) {
        $words = implode(" ", array_slice($word_arr , 0, $limit) ) . ' ...';
        return $words;
    }

    return $text;
}