<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Attachment;
use App\Category;

class AttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $attachment = Attachment::with('category');
        if(request()->filled('keyword')){
            $attachment->where('title','like','%'.request()->keyword.'%');
        }
        if(request()->filled('category')){
            $attachment->where('category_id',request()->category);
        }
        $attachments = $attachment->paginate(12);
        return view('admin.attachments.index', [
            'title' => trans("admin.show all attachments"),
            'index' => $attachments,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.attachments.create', [
            'title' => trans("admin.add attachments"),
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
       $this->rules['title'] = 'required|unique:attachments,title';
       $this->rules['description'] = 'sometimes|nullable';
       $this->rules['image'] = 'required|mimes:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf,zip';
       $this->rules['category_id'] = 'required|exists:categories,id';
       $data = $this->validate($request, $this->rules);
       $data['admin_id'] = auth()->guard('webAdmin')->id();
       // If Upload File File
       // Delete Old File
       if ($request->hasFile('image')) {
           //Setting For Name file and Path
           $destination = "uploads/attachments/" . date("Y") . "/" . date("m") . "/";
           $file = request()->file('image');
           $name = $file->getClientOriginalName(); // get image name
           $extension = $file->getClientOriginalExtension(); // get image extension
           $sha1 = sha1($name); // hash the image name
           $random = rand(1, 1000000); // Random To Name
           $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
           $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
           $file->move($destination, $fileName); // Upload Attachment
           $data['attachments'] = "attachments/" . date("Y") . "/" . date("m") . "/" . $name_database . "." . $extension; // Create Name To Send It
       }
       // Create and Message Success
       Attachment::create($data);
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->route('attachments.create');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Attachments = Attachment::findOrFail($id);
        $categories = Category::all();
        return view('admin.attachments.edit', [
            'title' => trans("admin.edit attachments") . ' : ' . $Attachments->title,
            'edit'  => $Attachments,
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
        $attachment = Attachment::findOrFail($id);
        // Make Validation
        $this->rules['title'] = 'required|unique:attachments,title, ' . $id;
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['attachments'] = 'sometimes|nullable|mimes:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf,zip';
        $this->rules['category_id'] = 'required|exists:categories,id';
        $data = $this->validate($request, $this->rules);
        // If Upload File File
        // Delete Old File
        if ($request->hasFile('image')) {
            if (file_exists(public_path("uploads/". $attachment->attachments))) {
                @unlink(public_path("uploads/". $attachment->attachments));
            }
            //Setting For Name file and Path
            $destination = "uploads/attachments/" . date("Y") . "/" . date("m") . "/";
            $file = request()->file('image');
            $name = $file->getClientOriginalName(); // get image name
            $extension = $file->getClientOriginalExtension(); // get image extension
            $sha1 = sha1($name); // hash the image name
            $random = rand(1, 1000000); // Random To Name
            $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
            $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
            $file->move($destination, $fileName); // Upload Zip Scorm Step1
            $data['attachments'] = "attachments/" . date("Y") . "/" . date("m") . "/" . $name_database . "." . $extension; // Create Name To Send It
        }
        //Update Data
        $attachment->update($data);
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/attachments');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
         $attachment = Attachment::findOrFail($id);
         if (file_exists(public_path("uploads/". $attachment->attachments))) {
             @unlink(public_path("uploads/". $attachment->attachments));
         }
         $attachment->delete();
         return  redirect()->back();
     }


}
