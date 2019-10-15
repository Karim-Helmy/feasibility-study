<?php

namespace App\Http\Controllers\Super;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use App\Imports\UsersImport;
use App\Course;
use App\CourseUser;
use App\GroupUser;
use App\StudentGroup;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','!=','1');
        if(request()->filled('email')){
            $user->where('email','like','%'.request()->email.'%');
        }
        if(request()->filled('id')){
            $user->where('id',request()->id);
        }
        if(request()->filled('type')){
            $user->where('type',request()->type);
        }
        $users = $user->paginate(12);
        return view('super.users.index', [
            'title' => trans("admin.show"),
            'index' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::where([
            ['status','1'],
            ['subscriber_id',auth()->user()->subscriber_id],
        ])->get();
        $fathers = User::where([
            ['status','1'],
            ['type','4'],
            ['subscriber_id',auth()->user()->subscriber_id],
        ])->get();
        return view('super.users.create', [
            'courses'  => $courses,
            'fathers'    => $fathers,
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
       $fathers = User::where([
           ['status','1'],
           ['type','4'],
           ['subscriber_id',auth()->user()->subscriber_id],
       ])->get();
       $implode = implode(',',$fathers->pluck("id")->toArray());
       //Make Validation
       $this->rules['name'] = 'required|max:250';
       $this->rules['username'] = 'required|max:250|unique:users,username';
       $this->rules['email'] = 'sometimes|nullable|email|max:50';
       $this->rules['phone'] = 'sometimes|nullable';
       $this->rules['mobile'] = 'sometimes|nullable|regex:/(05)[0-9]{8}/|size:10';
       $this->rules['address'] = 'sometimes|nullable|max:200';
       $this->rules['nationality'] = 'sometimes|nullable|max:200';
       $this->rules['status'] = 'sometimes|nullable|in:0,1';
       $this->rules['type'] = 'required|in:2,3,4';
       $this->rules['password'] = 'required|min:6|confirmed';
       $this->rules['image'] = 'sometimes|nullable|image';
       $this->rules['birth_date'] = 'sometimes|nullable|date|before:today|after:1930-01-01';
       $this->rules['course_id'] = 'sometimes|nullable|exists:courses,id';
       $this->rules['father_id'] = 'sometimes|nullable|in:'.$implode;
       $data = $this->validate($request, $this->rules);
       // Hash password
       $data['password'] = Hash::make($request->password);
       // subscriber_id
       $data['subscriber_id'] = $subscriber_id;
       // Upload Image
       if ($request->hasFile('image')) {
          $destination = "uploads/" . $subscriber_id . "/profile/" . date("Y") . "/" . date("m") . "/";
          $data['photo'] = UploadImages($destination, $request->file('image')); // Upload Image
      }
       //Create User And Success Message
       $user = User::create($data);
       // if user is not father .. insert student an trainer in this course
       if($user->type != 4){
           if($request->course_id){
               CourseUser::create([
                   'course_id' => $request->course_id,
                   'user_id'   => $user->id,
                   'type'      => $user->type,
               ]);
           }
       }
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
        $users = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','!=','1')->where('id',$id)->firstOrFail();
        $fathers = User::where([
            ['status','1'],
            ['type','4'],
            ['subscriber_id',auth()->user()->subscriber_id],
        ])->get();
        return view('super.users.edit', [
            'edit'     => $users,
            'fathers'  => $fathers,
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
       $users = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','!=','1')->where('id',$id)->firstOrFail();
       $subscriber_id = auth()->user()->subscriber_id;
       $fathers = User::where([
           ['status','1'],
           ['type','4'],
           ['subscriber_id',auth()->user()->subscriber_id],
       ])->get();
       $implode = implode(',',$fathers->pluck("id")->toArray());
       //Make Validation
       $this->rules['name'] = 'required|max:250';
       $this->rules['username'] = 'required|max:250|unique:users,username,'.$id;
       $this->rules['email'] = 'sometimes|nullable|email|max:50';
       $this->rules['phone'] = 'sometimes|nullable';
       $this->rules['mobile'] = 'sometimes|nullable|regex:/(05)[0-9]{8}/|size:10';
       $this->rules['address'] = 'sometimes|nullable|max:200';
       $this->rules['nationality'] = 'sometimes|nullable|max:200';
       $this->rules['status'] = 'sometimes|nullable|in:0,1';
       $this->rules['type'] = 'required|in:2,3,4';
       $this->rules['password'] = 'sometimes|nullable|min:6|confirmed';
       $this->rules['image'] = 'sometimes|nullable|image';
       $this->rules['birth_date'] = 'sometimes|nullable|date|before:today|after:1930-01-01';
       $this->rules['father_id'] = 'sometimes|nullable|in:'.$implode;
       $data = $this->validate($request, $this->rules);
       // Hash password
       if($request->password){
           $data['password'] = Hash::make($request->password);
       }else{
           $data['password'] = $users->password;
       }
       // subscriber_id
       $data['subscriber_id'] = $subscriber_id;
       // Upload Image
       if ($request->hasFile('image')) {
           if (file_exists(public_path('uploads/' . $users->photo))) {
               @unlink(public_path('uploads/' . $users->photo));
           }
          $destination = "uploads/" . $subscriber_id . "/profile/" . date("Y") . "/" . date("m") . "/";
          $data['photo'] = UploadImages($destination, $request->file('image')); // Upload Image
      }
       //Create User And Success Message
       $users->update($data);

       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->back();
   }


    /**
     * Show  Upload Excel File
     *
     * @return \Illuminate\Http\Response
     */
    public function excel()
    {
        $courses = Course::where([
            ['status','1'],
            ['subscriber_id',auth()->user()->subscriber_id],
        ])->get();
        return view('super.users.excel', [
            'courses'  => $courses,
        ]);
    }

    /**
     * [import Students Excel File]
     * 0 => name , 1 => username , 2 => Password , 3 => type (in:2,3,4) (2 => Trainer , 3 => Student , 4 => Father)
     * @param  Request $request [File Excel]
     * @return [type]           [Success Message And Return Back]
     */
    public function import(Request $request)
   {
       // Make Validation
        $this->rules['excel'] = 'required|mimes:xlsx,xls,csv';
        $this->rules['group'] = 'sometimes|nullable|max:200|min:4';
        $this->rules['course_id'] = 'sometimes|nullable|exists:courses,id';
        $data = $this->validate($request, $this->rules);
        //Upload Excel File and Insert data
        Excel::import(new UsersImport, $request->file('excel'));
        //Return inserted data by excel file
        $excel = Excel::toArray(new UsersImport, $request->file('excel'));
        // if group is found create new student group
        if($request->group){
            $group = StudentGroup::create([
                'title'         => $request->group,
                'subscriber_id' => auth()->user()->subscriber_id,
            ]);
        }
        // foreach all users in excel file
        foreach ($excel[0] as $key => $row) {
            $username = $row[1];
            $user = User::where('username',$username)->first();
            // if user is student -> insert in this group
            if($user->type == 3){
                if($request->group){
                    GroupUser::create([
                        'student_group_id' => $group->id,
                        'user_id'          => $user->id,
                    ]);
                }
            }
            // if user is not father .. insert student an trainer in this course
            if($user->type != 4){
                if($request->course_id){
                    CourseUser::create([
                        'course_id' => $request->course_id,
                        'user_id'   => $user->id,
                        'type'      => $user->type,
                    ]);
                }
            }
        }
        // Success Message And Return Back
        session()->flash('success', trans("admin.Created Successfully"));
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
            $user = User::where('subscriber_id',auth()->user()->subscriber_id)->where('type','!=','1')->where('id',$id)->firstOrFail();
            $user->delete();
            return  redirect()->back();
        }


}
