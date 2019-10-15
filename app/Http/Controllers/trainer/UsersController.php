<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\CourseUser;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id)
    {
        CourseUser::where('type','2')->where('course_id',$course_id)->where('user_id',auth()->id())->firstOrFail();
        $users = CourseUser::with('user')->whereHas('user',function($query){
            $query->where('type','3');
        })->where('course_id',$course_id)->get();
        return view('trainer.users.index', [
            'users' => $users,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function type($id)
    {
        $users = CourseUser::where('id',$id)->firstOrFail();
        CourseUser::where('type','2')->where('course_id',$users->course_id)->where('user_id',auth()->id())->firstOrFail();
        return view('trainer.users.type', [
            'edit' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function typeUpdate(Request $request,$id)
    {
        $users = CourseUser::where('id',$id)->firstOrFail();
        CourseUser::where('type','2')->where('course_id',$users->course_id)->where('user_id',auth()->id())->firstOrFail();
        // Make Validation
        $this->rules['type'] = 'required|in:2,3';
        $data = $this->validate($request, $this->rules);
        //Update Data
        $users->update($data);
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
        $users = CourseUser::where('id',$id)->firstOrFail();
        CourseUser::where('type','2')->where('course_id',$users->course_id)->where('user_id',auth()->id())->firstOrFail();
        $users->delete();
        return redirect()->back();
    }


}
