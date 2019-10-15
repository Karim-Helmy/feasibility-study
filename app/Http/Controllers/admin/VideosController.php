<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\Category;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $video = Video::where('admin_id','!=','0')->with('category');
        if(request()->filled('keyword')){
            $video->where('title','like','%'.request()->keyword.'%');
        }
        if(request()->filled('category')){
            $video->where('category_id',request()->category);
        }
        $videos = $video->paginate(12);
        return view('admin.videos.index', [
            'title' => trans("admin.show all videos"),
            'index' => $videos,
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
        return view('admin.videos.create', [
            'title' => trans("admin.add videos"),
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
       $this->rules['title'] = 'required|unique:videos,title';
       $this->rules['description'] = 'sometimes|nullable';
       $this->rules['link'] = 'required|url';
       $this->rules['category_id'] = 'required|exists:categories,id';
       $data = $this->validate($request, $this->rules);
       $data['admin_id'] = auth()->guard('webAdmin')->id();
       Video::create($data);
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->route('videos.create');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $videos = Video::where('admin_id','!=','0')->where('id',$id)->firstOrFail();
        $categories = Category::all();
        return view('admin.videos.edit', [
            'title' => trans("admin.edit videos") . ' : ' . $videos->title,
            'edit'  => $videos,
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
        // Make Validation
        $this->rules['title'] = 'required|unique:videos,title, ' . $id;
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['link'] = 'required|url';
        $this->rules['category_id'] = 'required|exists:categories,id';
        $data = $this->validate($request, $this->rules);
        //Update Data
        Video::where('admin_id','!=','0')->where('id',$id)->update($data);
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/videos');
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
         $video = Video::where('admin_id','!=','0')->where('id',$id)->firstOrFail();
         $video->delete();
         return  redirect()->back();
     }


}
