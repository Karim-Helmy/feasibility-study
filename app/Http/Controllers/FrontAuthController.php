<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;

class FrontAuthController extends Controller
{
    public function sessionStore()
    {
        if(!auth()->attempt(request(['username', 'password'])))
        {
            return redirect('/login')->with([
                'error' => "Sorry, write your username and password again!",
            ]);
        }
        User::where('id',auth()->id())->update(['last_login' => date('Y-m-d H:i:s')]);
        return redirect('/checklogin');
    }


    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        Session::forget('project_id');
        auth()->logout();
        return redirect('/login');
    }
}
