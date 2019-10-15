<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Level;
use App\Category;
use App\User;
use App\CourseUser;



class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::where('subscriber_id','=',auth()->id())->get();
        return view('super.courses.show', [
            'title' => trans('admin.show all courses'),
            'index' => $course,
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
        return view('super.courses.create', [
            'title' => trans("admin.add course"),
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
        $subscriber_id = auth()->user()->subscriber_id;
        // Make Validation
        $this->rules['name'] = 'required|unique:courses,title';
        $this->rules['start_date'] = 'required|date';
        $this->rules['end_date'] = 'required|date';
        $this->rules['days_no'] = 'required|numeric';
        $this->rules['hours_no'] = 'required|numeric';
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['repeater'] = 'required';
        $this->rules['active'] = 'required|numeric';
        $this->rules['image'] = 'required|image';
        $this->rules['category_id'] = 'required|exists:categories,id';

        $data = $this->validate($request, $this->rules);
        $add = new Course;
        // subscriber_id
        $add->subscriber_id = $subscriber_id;
        // Upload Image
        if ($request->hasFile('image')) {
            $destination = "uploads/" . $subscriber_id . "/profile/" . date("Y") . "/" . date("m") . "/";
            $add->logo = UploadImages($destination, $request->file('image')); // Upload Image
        }
        $add->title = $request->name;
        $add->start_date = $request->start_date;
        $add->end_date = $request->end_date;
        $add->days_no = $request->days_no;
        $add->hours_no = $request->hours_no;
        $add->description = $request->description;
        $add->status = $request->active;
        $add->category_id = $request->category_id;
        $add->save();
        //add levels
        $lastid  = $add->id;
        $levels = $request->repeater;
        foreach ($levels as $level)
        {
            if ($level['level_name'] !== null && $level['level_number'] !== null)
            {
                $addlevels= new Level();
                $addlevels->subscriber_id  =  $subscriber_id;
                $addlevels->course_id  =  $lastid;
                $addlevels->title = $level['level_name'];
                $addlevels->ordering = $level['level_number'];
                $addlevels->save();
           }
        }
        session()->flash('success', trans("admin.add Successfully"));
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();
        return view('super.courses.edit', [
            'title' => trans("admin.edit Course") . ' : ' . $course->title,
            'edit'  => $course,
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
        $subscriber_id = auth()->user()->subscriber_id;
        // Make Validation
        $this->rules['name'] = 'required|unique:courses,title, ' . $id;
        $this->rules['start_date'] = 'date';
        $this->rules['end_date'] = 'date';
        $this->rules['days_no'] = 'required|numeric';
        $this->rules['hours_no'] = 'required|numeric';
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['category_id'] = 'required|exists:categories,id';
        $this->rules['active'] = 'required|numeric';
        $this->rules['image'] = 'image';
        $data = $this->validate($request, $this->rules);
        $edit = Course::find($id);;
        // subscriber_id
        $edit->subscriber_id = $subscriber_id;
        // Upload Image
        if ($request->hasFile('image')) {
            if (file_exists(public_path('uploads/' . $edit->logo))) {
                @unlink(public_path('uploads/' . $edit->logo));
            }
            $destination = "uploads/" . $subscriber_id . "/profile/" . date("Y") . "/" . date("m") . "/";
            $edit->logo = UploadImages($destination, $request->file('image')); // Upload Image
        }
        $edit->title = $request->name;
        $edit->start_date = $request->start_date;
        $edit->end_date = $request->end_date;
        $edit->days_no = $request->days_no;
        $edit->hours_no = $request->hours_no;
        $edit->description = $request->description;
        $edit->category_id = $request->category_id;
        $edit->status = $request->active;

        $edit->save();
        //add levels
        $levels = $request->repeater;
        foreach ($levels as $level)
        {
            if ($level['level_name'] !== null && $level['level_number'] !== null)
            {
                $addlevels= new Level();
                $addlevels->subscriber_id  =  $subscriber_id;
                $addlevels->course_id  =  $id;
                $addlevels->title = $level['level_name'];
                $addlevels->ordering = $level['level_number'];
                $addlevels->save();
            }
        }
        session()->flash('success', trans("admin.add Successfully"));
        return back();
    }


    //assign user to course
    public function courseuser(Request $request)
    {
        $this->rules['user_id'] = 'required|numeric';
        $this->rules['course_id'] = 'required|numeric';
        $data = $this->validate($request, $this->rules);
        $user     = $request->user_id;
        $usertype = $request->user_type;
        $course   = $request->course_id;
        $addusertocourse= new CourseUser();
        $addusertocourse->user_id = $user;
        $addusertocourse->type = $usertype;
        $addusertocourse->course_id = $course;
        session()->flash('success',trans('admin.add Successfully'));
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Delete levels
    public function destroylevels($id)
    {
        $delete = Level::find($id);
        $delete->delete();
        session()->flash('success',trans('admin.deleted'));
        return back();
    }

    //Delete Course
    public function destroy( $id)
    {
        $delete =  Course::find($id);
        if (file_exists(public_path('uploads/' . $delete->logo))) {
            @unlink(public_path('uploads/' . $delete->logo));
        }
        $delete->delete();
        $affectedLevels = Level::where('course_id', $id)->get()->all();
        foreach ($affectedLevels as $affectedLevels){
            $affectedLevels->delete();
        }
        session()->flash('success',trans('admin.deleted'));
        return back();
    }
}
