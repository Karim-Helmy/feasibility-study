<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ScormCourse;
use App\Scorm;
use App\Level;


class ScormsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int  $level_id
     * @return \Illuminate\Http\Response
     */
    public function index($level_id)
    {
        // Check Permission
        $check = Level::where('id',$level_id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        //Get Scorms
        $scorms = ScormCourse::where('level_id',$level_id)->where('subscriber_id',auth()->user()->subscriber_id)->orderBy('id','desc')->get();
        return view('trainer.scorms.index', [
            'scorms' => $scorms,
            'id' => $level_id,
        ]);
    }


   /**
    * Show the form for creating a new resource.
    * @param  int  $level_id
    * @return \Illuminate\Http\Response
    */
   public function choose($level_id)
   {
       //Check Permission
       $level = Level::where('id',$level_id)->whereHas('course.courseUser',function($query){
           $query->where('user_id',auth()->id());
       })->where('subscriber_id',auth()->user()->subscriber_id)->with('course:id,category_id')->firstOrFail();
       //Admin Scorms
       $scorms = Scorm::where('admin_id','!=','0')->where('category_id',$level->course->category_id)->paginate('30');
       return view('trainer.scorms.choose', [
           'id'    => $level_id,
           'scorms'=> $scorms,
       ]);
   }

   /**
   * Store a newly created resource in storage.
   * @param  int  $level_id
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function storeChoose(Request $request,$level_id)
  {
     //Check Permission
      $category = Level::where('id',$level_id)->whereHas('course.courseUser',function($query){
          $query->where('user_id',auth()->id());
      })->where('subscriber_id',auth()->user()->subscriber_id)->with('course:id,category_id')->firstOrFail();
      //Assign Scorm to This Level
      foreach ($request->scorm_id as $key => $value) {
          ScormCourse::UpdateOrCreate([
              'scorm_id'      => $value,
              'level_id'      => $level_id,
              'subscriber_id' => auth()->user()->subscriber_id,
          ]);
      }
      session()->flash('success', trans("admin.add Successfully"));
      return redirect()->back();
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
            //Check Permissions
            $check = ScormCourse::where('subscriber_id',auth()->user()->subscriber_id)
            ->whereHas('level',function($query){
                $query->whereHas('course.courseUser',function($query){
                    $query->where('user_id',auth()->id());
                });
            })->where('scorm_id',$id)->firstOrFail();
            //Find And Delete
            $scorm = Scorm::findOrFail($id);
            if($scorm->admin_id != '0'){
                //IF This Scorm Created By Admin
                ScormCourse::where('scorm_id',$id)->where('level_id',$check->level_id)->delete();
            }
            return  redirect()->back();
        }


}
