<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Option;
use App\Package;
use App\Subscriber;
use App\PackageOption;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.packages.index', [
            'title' => trans("admin.show all packages"),
            'index' => Package::all()
        ]);
    }

    /**
     * [show Details Of packages]
     * @param  [int] $id [Id of packages]
     * @return [array]     [description]
     */
    public function show($id)
    {
        $today = date('Y-m-d');
        // For Statistics
        $subscibers = Subscriber::where('package_id',$id)->get();
        $subsciber_all = Subscriber::where('package_id',$id)->count();
        $subscibers_agree_get = Subscriber::where('package_id',$id)->where('status','1')->get();
        $subsciber_agree = $subscibers_agree_get->count();
        $subscibers_waiting_get = Subscriber::where('package_id',$id)->where('status','0')->get();
        $subsciber_waiting = $subscibers_waiting_get->count();
        $subsciber_today = Subscriber::where('package_id',$id)->whereDate('created_at',$today)->count();
        // Return Data
        return view('admin.packages.show', [
            'title' => trans("admin.packages"),
            'package' => Package::with('option')->where('id',$id)->firstOrFail(),
            // For Statistics
            'subscibers_agree_get' => $subscibers_agree_get,
            'subscibers_waiting_get' => $subscibers_waiting_get,
            'subsciber_all' => $subsciber_all,
            'subsciber_agree' => $subsciber_agree,
            'subsciber_waiting' => $subsciber_waiting,
            'subsciber_today' => $subsciber_today,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = Option::all();
        return view('admin.packages.create', [
            'title' => trans("admin.add package"),
            'options' => $options,
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
       //Make Validation
       $this->rules['name'] = 'required|max:200';
       $this->rules['price'] = 'required|integer';
       $this->rules['option'] = 'required|array';
       $data = $this->validate($request, $this->rules);
       //Create New Packages
       $package = Package::create($data);
       //Add Options To This Packages
       foreach ($data['option'] as $key => $value) {
           if($value){
               PackageOption::create([
                   'package_id' => $package->id,
                   'option_id'  => (int)$key,
                   'value'      => "$value"
               ]);
           }
       }
       //Success Messages
       session()->flash('success', trans("admin.add Successfully"));
       return redirect()->route('packages.create');
   }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::where('id',$id)->with('option')->firstOrFail();
        $options = Option::all();
        return view('admin.packages.edit', [
            'title' => trans("admin.edit package") . ' : ' . $package->name,
            'edit'  => $package,
            'options'  => $options,
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
        // Make Validation
        $this->rules['name'] = 'required|max:200';
        $this->rules['price'] = 'required|integer';
        $data = $this->validate($request, $this->rules);
        //Update Data
        Package::where('id',$id)->update($data);
        //Add Options To This Packages
        foreach ($request->option as $key => $value) {
                PackageOption::where('option_id',$key)->where('package_id',$id)->update([
                    'value'      => "$value"
                ]);
        }
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect('admin/packages');
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
        $package = Package::findOrFail($id);
        if ($package) {
            $package->delete();
        }
    }


}
