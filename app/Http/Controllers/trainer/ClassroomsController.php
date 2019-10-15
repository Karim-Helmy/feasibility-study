<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CourseUser;
use App\Classroom;


class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        // Check Permission
        $rooms = Classroom::where('course_id',$course_id)->where('subscriber_id',auth()->user()->subscriber_id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->get();
        //Get Videos
        return view('trainer.rooms.index', [
            'rooms' => $rooms,
            'id' => $course_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        CourseUser::where('course_id',$course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
        return view('trainer.rooms.create', [
            'id'    => $course_id,
        ]);
    }

    /**
    * Store a newly created resource in storage.
    * @param  int  $course_id
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request,$course_id)
   {
       //Make Validation
       $this->rules['title'] = 'required|max:200';
       $this->rules['start_date'] = 'sometimes|nullable'; // Validation Not Completed
       $this->rules['end_date'] = 'sometimes|nullable'; // Validation Not Completed
       $this->rules['class_no'] = 'sometimes|nullable|integer';
       $this->rules['link'] = 'required|url';
       $data = $this->validate($request, $this->rules);
       //Create Video
       CourseUser::where('course_id',$course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
       $data['course_id'] = $course_id;
       $data['user_id'] = auth()->id();
       $data['subscriber_id'] = auth()->user()->subscriber_id;
       $room = Classroom::create($data);
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->back();
   }

       /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
       public function edit($id)
       {
           $rooms = Classroom::where('subscriber_id',auth()->user()->subscriber_id)->where('id',$id)->firstOrFail();
           return view('trainer.rooms.edit', [
               'title' => 'edit',
               'edit'  => $rooms,
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
           //Check Permissions
           $rooms = Classroom::where('id',$id)->firstOrFail();
           CourseUser::where('course_id',$rooms->course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
           // Make Validation
           $this->rules['title'] = 'required|max:200';
           $this->rules['start_date'] = 'sometimes|nullable'; // Validation Not Completed
           $this->rules['end_date'] = 'sometimes|nullable'; // Validation Not Completed
           $this->rules['class_no'] = 'sometimes|nullable|integer';
           $this->rules['link'] = 'required|url';
           $data = $this->validate($request, $this->rules);
           //Update Data
           $data['course_id'] = $rooms->course_id;
           $data['user_id'] = auth()->id();
           $data['subscriber_id'] = auth()->user()->subscriber_id;
           $rooms->update($data);
           // Success Message
           session()->flash('success', trans("admin.edit Successfully"));
           return  redirect()->back();
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
            //Find And Delete
            $room = Classroom::findOrFail($id);
            CourseUser::where('course_id',$room->course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
            $room->delete();
            return  redirect()->back();
        }


}
