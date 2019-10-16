<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// langauge (Arabic - English)
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

// Login
Auth::routes();
Route::get('/login', function () {
    if (isset(Auth::user()->id)) {
        return redirect('/');
    } else {
        return view('auth.login');
    }
});

//Make Login
Route::post('sessionstore', 'FrontAuthController@sessionStore');
Route::get('checklogin', array('as' => 'checklogin', function () {
    if (isset(Auth::user()->id) && Auth::user()->status == 1) {
        if (Auth::user()->type == '1') {
            return redirect('/user/home');

        }elseif (Auth::user()->type == '2') {
            return redirect('/trainer/home');
        }
        elseif (Auth::user()->type == '3') {
            return redirect('/student/home');
        } else {
            auth()->logout();
            return redirect('/login')->with([
                'error' => "Sorry, write your username and password again!",
            ]);
        }
    } else {
        auth()->logout();
        return redirect('/login')->with([
            'error' => "Sorry, Your Username isn't active!",
        ]);
    }
}));

//Logout
Route::group(['middleware' => 'auth'], function(){
    Route::get('/logout', 'FrontAuthController@logout');
});

//ClearCache
Route::get('/clearcache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
