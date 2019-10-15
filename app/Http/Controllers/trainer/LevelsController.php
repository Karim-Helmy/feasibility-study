<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CourseUser;
use App\Level;

class LevelsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function media($id)
    {
        $level =Level::where('id',$id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        return view('trainer.levels.media', [
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level =Level::where('id',$id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        return view('trainer.levels.edit', [
            'edit' => $level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $level =Level::where('id',$id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        // Make Validation
        $this->rules['title'] = 'required|max:200';
        $this->rules['ordering'] = 'required|integer';
        $data = $this->validate($request, $this->rules);
        //Update Data
        $level->update($data);
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
        $level =Level::where('id',$id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        $level->delete();
        return redirect()->back();
    }

}
