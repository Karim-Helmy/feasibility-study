<?php

namespace App\Http\Controllers\trainer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GroupUser;
use App\StudentGroup;
use App\ProjectUser;
use App\Project;
use App\User;
use App\Level;

class ProjectsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $level_id
     * @return \Illuminate\Http\Response
     */
    public function index($level_id)
    {
        $projects = Project::where('subscriber_id',auth()->user()->subscriber_id)->where('level_id',$level_id)->whereHas('level.course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->with('level.course:id,title')->get();
        return view('trainer.projects.index', [
            'projects' => $projects,
            'id' => $level_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  int  $level_id
     * @return \Illuminate\Http\Response
     */
    public function create($level_id)
    {
        $users  = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','3')->get();
        $groups = StudentGroup::where('subscriber_id',auth()->user()->subscriber_id)->get();
        return view('trainer.projects.create', [
            'id'     => $level_id,
            'users'  => $users,
            'groups' => $groups,
        ]);
    }

    /**
    * Store a newly created resource in storage.
    * @param  int  $level_id
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request,$level_id)
   {
       //Make Validation
       $this->rules['title'] = 'required|max:200';
       $this->rules['description'] = 'sometimes|nullable';
       $this->rules['start_date'] = 'required|date|after_or_equal:today';
       $this->rules['end_date'] = 'required|date|after:start_date';
       $this->rules['total'] = 'required|integer';
       $this->rules['image'] = 'sometimes|nullable|mimes:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf,zip,png,jpg,gif,jpeg';
       $this->rules['file_upload'] = 'required|in:0,1';
       $this->rules['user_id'] = 'sometimes|nullable|array|in:'.implode(',',User::where('type','3')->where('subscriber_id',auth()->user()->subscriber_id)->get()->pluck('id')->toArray());
       $this->rules['group_id'] = 'sometimes|nullable|array|exists:student_groups,id';
       $data = $this->validate($request, $this->rules);
       //Create Project
       Level::where('id',$level_id)->whereHas('course.courseUser',function($query){
           $query->where('user_id',auth()->id());
       })->where('subscriber_id',auth()->user()->subscriber_id)->firstOrFail(); //For Check
       // Fixed Data
       $data['user_id'] = auth()->id();
       $data['level_id'] = $level_id;
       $data['subscriber_id'] = auth()->user()->subscriber_id;
       // Start Upload File
       if ($request->hasFile('image')) {
           $destination = "uploads/uploads/" . auth()->user()->subscriber_id . "/projects/" . date("Y") . "/" . date("m") . "/";
           $destination_database = "uploads/" . auth()->user()->subscriber_id . "/projects/" . date("Y") . "/" . date("m") . "/";
           //Setting For Name file and Path
           $file = request()->file('image');
           $name = $file->getClientOriginalName(); // get image name
           $extension = $file->getClientOriginalExtension(); // get image extension
           $sha1 = sha1($name); // hash the image name
           $random = rand(1, 1000000); // Random To Name
           $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
           $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
           $file->move($destination, $fileName); // Upload Attachment
           $data['file'] = $destination_database . $fileName; // Create Name To Send It
       }
       // End Upload File
       $project = Project::create($data);
       //Assign Users To Project
       if(!empty($request->group_id)){
           foreach ($request->group_id as $key => $group) {
               $user_group = GroupUser::where('student_group_id',$group)->get();
               foreach ($user_group as $key => $user) {
                   ProjectUser::UpdateOrCreate(
                       ['project_id'  => $project->id,
                        'user_id'     => $user->user_id]
                  );
               }
           }
       }
       if(!empty($request->user_id)){
           foreach ($request->user_id as $key => $user) {
               ProjectUser::UpdateOrCreate(
                   ['project_id'  => $project->id,
                    'user_id'     => $user]
              );
           }
       }
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->back();
   }


    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('id',$id)->whereHas('level.course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->with('projectUser:project_id,user_id')->firstOrFail();
        $choose = [];
        $choose_users = $project->projectUser;
        foreach ($project->projectUser as $user) {
            $choose[] = $user->user_id;
        }
        $users  = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','3')->get();
        $groups = StudentGroup::where('subscriber_id',auth()->user()->subscriber_id)->get();
        return view('trainer.projects.edit', [
            'title' => 'title',
            'edit' => $project,
            'users'  => $users,
            'groups' => $groups,
            'choose' => $choose,
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
        $project = Project::where('id',$id)->whereHas('level.course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        //Make Validation
        $this->rules['title'] = 'required|max:200';
        $this->rules['description'] = 'sometimes|nullable';
        $this->rules['start_date'] = 'required|date|after_or_equal:today';
        $this->rules['end_date'] = 'required|date|after:start_date';
        $this->rules['total'] = 'required|integer';
        $this->rules['image'] = 'sometimes|nullable|mimes:doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,pdf,zip,png,jpg,gif,jpeg';
        $this->rules['file_upload'] = 'required|in:0,1';
        $this->rules['user_id'] = 'sometimes|nullable|array|exists:users,id';
        $this->rules['group_id'] = 'sometimes|nullable|array|exists:student_groups,id';
        $data = $this->validate($request, $this->rules);
        //Create Project
        Level::where('id',$project->level_id)->whereHas('course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->where('subscriber_id',auth()->user()->subscriber_id)->firstOrFail(); //For Check
        // Fixed Data
        $data['user_id'] = auth()->id();
        $data['level_id'] = $project->level_id;
        $data['subscriber_id'] = auth()->user()->subscriber_id;
        // Start Upload File
        if ($request->hasFile('image')) {
           if (file_exists(public_path('uploads/' . $project->file))) {
               @unlink(public_path('uploads/' . $projec->file));
           }
            $destination = "uploads/uploads/" . auth()->user()->subscriber_id . "/projects/" . date("Y") . "/" . date("m") . "/";
            $destination_database = "uploads/" . auth()->user()->subscriber_id . "/projects/" . date("Y") . "/" . date("m") . "/";
            //Setting For Name file and Path
            $file = request()->file('image');
            $name = $file->getClientOriginalName(); // get image name
            $extension = $file->getClientOriginalExtension(); // get image extension
            $sha1 = sha1($name); // hash the image name
            $random = rand(1, 1000000); // Random To Name
            $name_database = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1; // To use it without extension
            $fileName = $random . "_" . date("y-m-d-h-i-s") . "_" . $sha1 . "." . $extension; // create new name for the file
            $file->move($destination, $fileName); // Upload Attachment
            $data['file'] = $destination_database . $fileName; // Create Name To Send It
        }
        // End Upload File
        //Update Data
        $project->update($data);
        if(!empty($request->user_id)){
            ProjectUser::where('project_id',$id)->delete();
        }
        //Assign Users To Project
        if(!empty($request->group_id)){
            foreach ($request->group_id as $key => $group) {
                $user_group = GroupUser::where('student_group_id',$group)->get();
                foreach ($user_group as $key => $user) {
                    ProjectUser::UpdateOrCreate(
                        ['project_id'  => $id,
                         'user_id'     => $user->user_id]
                   );
                }
            }
        }

        if(!empty($request->user_id)){
            foreach ($request->user_id as $key => $user) {
                ProjectUser::UpdateOrCreate(
                    ['project_id'  => $id,
                     'user_id'     => $user]
               );
            }
        }
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
        $project = Project::where('user_id',auth()->id())->where('id',$id)->whereHas('level.course.courseUser',function($query){
            $query->where('user_id',auth()->id());
        })->firstOrFail();
        $project->delete();
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function compelete($id)
    {
        $projects = ProjectUser::with('user','project.level.course')->whereHas('project.level.course.courseUser',function($query){
            $query->where('user_id',auth()->id())->where('type','2');
        })->whereNotNull('answer')->get();
        return view('trainer.projects.compelete', [
            'title' => 'title',
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function compeleteShow($id)
    {
        $project = ProjectUser::where('id',$id)->whereHas('project.level.course.courseUser',function($query){
            $query->where('user_id',auth()->id())->where('type','2');
        })->firstOrFail();
        return view('trainer.projects.show', [
            'title' => 'title',
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request,$id)
    {
        $project =ProjectUser::with('project')->where('id',$id)->whereHas('project.level.course.courseUser',function($query){
            $query->where('user_id',auth()->id())->where('type','2');
        })->firstOrFail();
        $total = $project->project->total;
        //Make Validation
        $this->rules['grade'] = 'required|integer|between:0,'.$total;
        $this->rules['notes'] = 'sometimes|nullable';
        $data = $this->validate($request, $this->rules);
        //Update Data
        $project->update($data);
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
        public function destroyRate($id)
        {
            $project =ProjectUser::with('project')->where('id',$id)->whereHas('project.level.course.courseUser',function($query){
                $query->where('user_id',auth()->id())->where('type','2');
            })->firstOrFail();
            $project->update([
                'answer' => null,
                'grade' => null,
                'notes' => null,
                'answer_file' => null,
            ]);
            return redirect()->back();
        }

}
