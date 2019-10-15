<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class ProfileController extends Controller
{

    /**
     * Show  the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::where('id',auth()->id())->first();
        return view('student.users.show', [
            'index' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::where('id',auth()->id())->first();
        return view('student.users.edit', [
            'edit' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = auth()->id();
        $user = User::findOrFail($id);
        // Make Validation
        $this->rules['email'] = 'sometimes|nullable|email';
        $this->rules['image'] = 'sometimes|nullable|image';
        $this->rules['phone'] = 'sometimes|nullable|numeric';
        $this->rules['mobile'] = 'sometimes|nullable|numeric|regex:/(05)[0-9]{8}/|size:10';
        $this->rules['birth_date'] = 'sometimes|nullable|date|before:today';
        $this->rules['old_password'] = 'sometimes|nullable|required_with:password';
        $this->rules['password'] = 'sometimes|nullable|min:6|confirmed';
        $data = $this->validate($request, $this->rules);
        //Update Data
       if($request->password){
           if (Hash::check($request->old_password, $user->password)) {
                $data['password'] = Hash::make($request->password);
            }else{
                return redirect()->back()->with([
                    'error' => trans("passwords.false"),
                ]);
            }
        }else{
            $data['password'] = $user->password;
        }
       if ($request->hasFile('image')) {
          if (file_exists(public_path('uploads/' . $user->photo))) {
              @unlink(public_path('uploads/' . $user->photo));
          }
          $destination = "uploads/" . $user->subscriber_id . "/profile/" . date("Y") . "/" . date("m") . "/";
          $data['photo'] = UploadImages($destination, $request->file('image')); // Upload Image
      }
        $user->update($data);
        // Success Message
        session()->flash('success', trans("admin.edit Successfully"));
        return  redirect()->back();
    }



}
