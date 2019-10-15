<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Hash;
use App\Package;
use App\Subscriber;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    /**
     * [index Admin]
     * @return [type] [description]
     */
    public function index()
    {
        $today = date('Y-m-d');
        // For Statistics
        $subsciber_all = Subscriber::count();
        $subsciber_agree = Subscriber::where('status','1')->count();
        $subsciber_waiting = Subscriber::where('status','0')->count();
        $subsciber_today = Subscriber::whereDate('created_at',$today)->count();
        // For Chart
        $packages = DB::table('subscribers')
                     ->select(DB::raw('count(package_id) as package_count,package_id, packages.name'))
                     ->rightJoin('packages', 'subscribers.package_id', '=', 'packages.id')
                     ->groupBy('package_id','packages.name')
                     ->get();
        return view('admin.index', [
            // For Statistics
            'subsciber_all' => $subsciber_all,
            'subsciber_agree' => $subsciber_agree,
            'subsciber_waiting' => $subsciber_waiting,
            'subsciber_today' => $subsciber_today,
            // For Chart
            'packages' => $packages
        ]);
    }


    /**
     * [login Admin]
     * @return [type] [description]
     */
    public function login(){
        if(auth()->guard('webAdmin')->check()){
            return redirect('/admin/index');
        }
        return view('admin.login');
    }

    /**
     * [store description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        //Validation
        $data = $this->validate($request, [
        'email'=>'required|email',
        'password'=>'required|min:6',
        ]);
        //IF Check On Remember Me
        if($request->remember == "on"){
            $remember = true;
        }else{
            $remember = false;
        }
        //Succes Message
        if(auth()->guard('webAdmin')->attempt($data,$remember)){
            return redirect('admin/index')->with([
            'message' => "You are logged in Successfully",
            ]);
        }
        //Error  Message
        return redirect('/admin/login')->with([
        'error' => "Sorry, write your email and password again!",
        ]);
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        auth()->guard('webAdmin')->logout();
        return redirect('/admin/login');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::where('id',$id)->firstOrFail();
        return view('admin.admins.edit', [
            'title' => trans("admin.edit admins") . ' : ' . $admin->username,
            'edit'  => $admin,
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
        $admin = Admin::where('id',$id)->firstOrFail();
        //Validation
        $this->rules['email'] = 'required|unique:admins,email,'.$id;
        $this->rules['username'] = 'required';
        $this->rules['phone'] = 'required|numeric|unique:admins,phone,'.$id;
        $data = $this->validate($request, $this->rules);
        //Update Admin
        $user = Admin::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        //Make Hash To Password
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/admins');
    }

    /**
     * [create New Admin]
     * @return [Create Page]
     */
    public function create(){
        return view('admin.admins.create',[
            'title'=>trans('admin.create new admin'),
        ]);
    }

    /**
     * [save new admin]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request){
        $data = $this->validate($request, [
            'username'=>'required',
            'email'=>'required|min:6|email|unique:admins,email',
            'phone'=>'required|numeric|unique:admins,phone',
            //'phone'=>'required|numeric|regex:/(05)[0-9]{8}/|unique:admins,phone',
            'password'=>'required|min:6',
        ]);
        $data['password'] = Hash::make($request->password);
        $admin = Admin::Create($data);
        return redirect(aurl('/admins'))->with(['success' => "Created Successfully"]);
    }

    /**
     * [admins description]
     * @return [type] [description]
     */
    public function admins(){
        return view('admin.admins.index',[
            'title'=>trans('admin.admins'),
            'admins'=>Admin::orderBy('created_at','desc')->get()
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  bool  $redirect
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        if (request()->filled('id')) {
            $id = request()->id;
        }
        $user = Admin::findOrFail($id);
        if ($user) {
            $count = Admin::count();
            if($count > 1){
                $user->delete();
            }
        }
    }

}
