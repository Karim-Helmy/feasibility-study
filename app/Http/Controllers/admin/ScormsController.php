<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Scorm;
use Zip;
use Zipper;
use \ZipArchive;
use Image;
use File;
use App\Category;
class ScormsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.scorms.index', [
            'title' => trans("admin.show all scorms"),
            'index' => Scorm::with('category')->get()
        ]);
    }


    /**
     * [show Details Of packages]
     * @param  [int] $id [Id of packages]
     * @return [array]     [description]
     */
    public function show($id)
    {
    $scorm = Scorm::findOrFail($id);
    $path = public_path('uploads/'.$scorm->scorm.'/imsmanifest.xml');
    $xml = file_get_contents($path);
    $xml = simplexml_load_string($xml);
    $content = json_decode(json_encode($xml),TRUE);
    $link = $content['resources']['resource']['@attributes']['href'];
    $full = asset('uploads/'.$scorm->scorm.'/imsmanifest.xml');
    return view('admin.scorms.show', [
        'title' => trans("admin.scorms"),
        'scorm' => $scorm->scorm,
        'link' => $link,
        'full' => $full
    ]);
    //return redirect("/uploads/n/".$link);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.scorms.create', [
            'title' => trans("admin.add scorm"),
            'categories' => $categories
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       // Make Validation
       $this->rules['title'] = 'required|unique:scorms,title';
       $this->rules['description'] = 'sometimes|nullable';
       $this->rules['image'] = 'required|mimes:zip';
       $this->rules['category_id'] = 'required|exists:categories,id';
       $data = $this->validate($request, $this->rules);

       // If Upload Scorm File
       // Delete Old Scorm
       if ($request->hasFile('image')) {
           if (file_exists(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $request->file('image')))) {
               @unlink(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $request->file('image')));
           }
           //Setting For Name file and Path
           $destination = "uploads/scorms/" . date("Y") . "/" . date("m") . "/";
           $file = request()->file('image');
           $name = $file->getClientOriginalName(); // get image name
           $extension = $file->getClientOriginalExtension(); // get image extension
           $sha1 = sha1($name); // hash the image name
           $random = rand(1, 1000000); // Random To Name
           $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
           $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
           $file->move($destination, $fileName); // Upload Zip Scorm Step1
           $data['scorm'] = "scorms/" . date("Y") . "/" . date("m") . "/" . $name_database; // Create Name To Send It
           $zip = Zip::create(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName)); // Upload Zip Scorm Step2
           $zip->extract(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1));//Extract Zip Scom
           $zip->close();
           if (file_exists(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName))) {
               unlink(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName));// Delete Zip File And Save Extract Files Only
           }
       }
       // Save Data
       $data['admin_id'] = auth()->guard('webAdmin')->id();
       Scorm::create($data);
       // Success Message and Redirect To Create Again
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->route('scorms.create');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scorm      = Scorm::findOrFail($id);
        $categories = Category::all();
        return view('admin.scorms.edit', [
            'title' => trans("admin.edit scorm") . ' : ' . $scorm->title,
            'edit'  => $scorm,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $scorm = Scorm::findOrFail($id);
        // Make Validation
        $this->rules['title'] = 'required|unique:options,name,'.$id;
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['image'] = 'sometimes|nullable|mimes:zip';
        $this->rules['category_id'] = 'required|exists:categories,id';
        $data = $this->validate($request, $this->rules);
        // If Upload Scorm File
        // Delete Old Scorm
        if ($request->hasFile('image')) {
            if (file_exists(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $scorm->scorm))) {
                @unlink(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $scorm->scorm));
            }
            $dir = public_path("uploads/". $scorm->scorm); // get all file names
            File::deleteDirectory($dir);
            //Setting For Name file and Path
            $destination = "uploads/scorms/" . date("Y") . "/" . date("m") . "/";
            $file = request()->file('image');
            $name = $file->getClientOriginalName(); // get image name
            $extension = $file->getClientOriginalExtension(); // get image extension
            $sha1 = sha1($name); // hash the image name
            $random = rand(1, 1000000); // Random To Name
            $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
            $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
            $file->move($destination, $fileName); // Upload Zip Scorm Step1
            $data['scorm'] = "scorms/" . date("Y") . "/" . date("m") . "/" . $name_database; // Create Name To Send It
            $zip = Zip::create(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName)); // Upload Zip Scorm Step2
            $zip->extract(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1));//Extract Zip Scom
            $zip->close();
            if (file_exists(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName))) {
                @unlink(public_path("uploads/scorms/" . date("Y") . "/" . date("m") . "/" . $fileName));// Delete Zip File And Save Extract Files Only
            }
        }
        //Update Data
        $data['admin_id'] = auth()->guard('webAdmin')->id();
        $scorm->update($data);
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/scorms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if (request()->filled('id')) {
            $id = request()->id;
        }
        $scorm = Scorm::findOrFail($id);
        if ($scorm) {
            //Delete Folder
            $dir = public_path("uploads/". $scorm->scorm); // get all file names
            File::deleteDirectory($dir);
            //Delete From Database
            $scorm->delete();
        }
    }


}
