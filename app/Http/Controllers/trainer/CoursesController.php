<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;



class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::whereHas('courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->with('category')->where('status','1')->orderBy('category_id','desc')->get();
        return view('trainer.courses.index', [
            'index' => $course,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::whereHas('courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->where('id',$id)->where('status','1')->with('level')->firstOrFail();
        return view('trainer.courses.show', [
            'course' => $course,
        ]);
    }


}
