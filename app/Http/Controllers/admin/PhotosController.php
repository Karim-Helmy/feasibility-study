<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Category;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $photo = Photo::with('category');
        if(request()->filled('keyword')){
            $photo->where('title','like','%'.request()->keyword.'%');
        }
        if(request()->filled('category')){
            $photo->where('category_id',request()->category);
        }
        $photos = $photo->paginate(12);
        return view('admin.photos.index', [
            'title' => trans("admin.show all photos"),
            'index' => $photos,
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
        return view('admin.photos.create', [
            'title' => trans("admin.add photos"),
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
       $this->rules['title'] = 'required|max:200|unique:photos,title';
       $this->rules['description'] = 'sometimes|nullable';
       $this->rules['image'] = 'required|image';
       $this->rules['category_id'] = 'required|exists:categories,id';
       $data = $this->validate($request, $this->rules);
       //Create New Photo
       $data['admin_id'] = auth()->guard('webAdmin')->id(); // Admin ID
       $destination = "uploads/images/" . date("Y") . "/" . date("m") . "/";
       $data['image'] = UploadImages($destination, $request->file('image')); // Upload Image
       Photo::create($data);
       //Success Message
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->route('photos.create');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photos = Photo::findOrFail($id);
        $categories = Category::all();
        return view('admin.photos.edit', [
            'title' => trans("admin.edit photos") . ' : ' . $photos->title,
            'edit'  => $photos,
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
        $photo = Photo::findOrFail($id);
        // Make Validation
        $this->rules['title'] = 'required|max:200|unique:photos,title, ' . $id;
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['image'] = 'sometimes|nullable|image';
        $this->rules['category_id'] = 'required|exists:categories,id';
        $data = $this->validate($request, $this->rules);
        //Update Data
        $data['admin_id'] = auth()->guard('webAdmin')->id();
        if ($request->hasFile('image')) {
           if (file_exists(public_path('uploads/' . $photo->image))) {
               @unlink(public_path('uploads/' . $photo->image));
           }
           $destination = "uploads/images/" . date("Y") . "/" . date("m") . "/";
           $data['image'] = UploadImages($destination, $request->file('image')); // Upload Image
       }
        $photo->update($data);
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/photos');
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
        $photos = Photo::findOrFail($id);
        if ($photos) {
            if (file_exists(public_path('uploads/' . $photos->image))) {
                @unlink(public_path('uploads/' . $photos->image));
            }
            $photos->delete();
        }
        return  redirect()->back();
    }


}
