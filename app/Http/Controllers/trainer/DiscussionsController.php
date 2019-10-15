<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DiscussionUser;
use App\CourseUser;
use App\Discussion;


class DiscussionsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        // Check Permission
        $discussions = Discussion::where('course_id',$course_id)->where('subscriber_id',auth()->user()->subscriber_id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->get();
        //Get Videos
        return view('trainer.discussions.index', [
            'discussions' => $discussions,
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
        return view('trainer.discussions.create', [
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
       $data = $this->validate($request, $this->rules);
       //Create Video
       CourseUser::where('course_id',$course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
       $data['course_id'] = $course_id;
       $data['user_id'] = auth()->id();
       $data['subscriber_id'] = auth()->user()->subscriber_id;
       $discussion = Discussion::create($data);
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
           $discussions = Discussion::where('subscriber_id',auth()->user()->subscriber_id)->where('id',$id)->firstOrFail();
           return view('trainer.discussions.edit', [
               'title' => 'edit',
               'edit'  => $discussions,
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
           $discussions = Discussion::where('id',$id)->firstOrFail();
           CourseUser::where('course_id',$discussions->course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
           // Make Validation
           $this->rules['title'] = 'required|max:200';
           $data = $this->validate($request, $this->rules);
           //Update Data
           $data['course_id'] = $discussions->course_id;
           $data['user_id'] = auth()->id();
           $data['subscriber_id'] = auth()->user()->subscriber_id;
           $discussions->update($data);
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
            $discussion = Discussion::findOrFail($id);
            CourseUser::where('course_id',$discussion->course_id)->where('user_id',auth()->id())->where('type','2')->firstOrFail(); //For Check
            $discussion->delete();
            return  redirect()->back();
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $discussions = DiscussionUser::where('discussion_id',$id)->with('discussion','user')->get();
            return view('trainer.discussions.show', [
                'discussions' => $discussions,
                'id'          => $id,
            ]);
        }


            /**
            * Store a newly created resource in storage.
            * @param  int  $course_id
            * @param  \Illuminate\Http\Request  $request
            * @return \Illuminate\Http\Response
            */
           public function comment(Request $request,$id)
           {
               //Make Validation
               $this->rules['comment'] = 'required';
               $data = $this->validate($request, $this->rules);
               //Create Video
               Discussion::where('id',$id)->where('subscriber_id',auth()->user()->subscriber_id)->whereHas('course.courseUser',function($query){
                   $query->where('user_id',auth()->id());
               })->firstOrFail(); //For Check
               $data['discussion_id'] = $id;
               $data['user_id'] = auth()->id();
               $data['type'] = auth()->user()->type;
               $discussion = DiscussionUser::create($data);
               session()->flash('success', trans("admin.add Successfully"));
               return redirect()->back();
           }



}
