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



Route::group(['namespace'=>'super'], function () {
//Home Page
    Route::get('/', 'HomeController@homepage');

});

// Login
Auth::routes();
Route::get('/login', function () {
    if (isset(Auth::user()->id)) {
        return redirect('/dashboard');
    } else {
        return view('auth.login');
    }
});

//Make Login
Route::post('sessionstore', 'FrontAuthController@sessionStore');
Route::get('checklogin', array('as' => 'checklogin', function () {
    if (isset(Auth::user()->id) && Auth::user()->status == 1) {
        if (Auth::user()->type == '1') {
            return redirect('/dashboard');
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
    Artisan::call('route:clear');




    return "Cleared!";
});

// For Language
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});
Auth::routes();
Route::group(['namespace'=>'super'], function () {


    // Must Login
    Route::group(['prefix' => 'dashboard','middleware' => ['Supervisor', 'auth']], function(){
        //Home
        Route::get('/', 'HomeController@index');




        //Team
        Route::get('team', 'TeamController@index');
        Route::post('team/store', 'TeamController@store');
        Route::post('team/update/{id}', 'TeamController@update')->name('super.team.update');
        Route::post('team/destroy/{id}', 'TeamController@destroy')->name('super.team.destroy');
        Route::get('autocomplete', 'TeamController@autocomplete')->name('autocomplete');

        //elements
        Route::get('elements', 'ElementsController@index');
        Route::post('elements/store', 'ElementsController@store');
        Route::post('elements/update/{id}', 'ElementsController@update')->name('super.elements.update');
        Route::post('elements/destroy/{id}', 'ElementsController@destroy')->name('super.elements.destroy');


        //fixed
        Route::get('fixed', 'FixedController@index');
        Route::post('fixed/store', 'FixedController@store');
        Route::post('fixed/update/{id}', 'FixedController@update')->name('super.fixed.update');
        Route::post('fixed/destroy/{id}', 'FixedController@destroy')->name('super.fixed.destroy');


        //administrative
        Route::get('administrative', 'AdministrativeController@index');
        Route::post('administrative/store', 'AdministrativeController@store');
        Route::post('administrative/update/{id}', 'AdministrativeController@update')->name('super.administrative.update');
        Route::post('administrative/destroy/{id}', 'AdministrativeController@destroy')->name('super.administrative.destroy');

        //finance
        Route::get('finance', 'FinanceController@index');
        Route::post('finance/store', 'FinanceController@store');
        Route::post('finance/update/{id}', 'FinanceController@update')->name('super.finance.update');
        Route::post('finance/updateadvantage', 'FinanceController@updateadvantage')->name('super.advantage.update');


        Route::post('finance/destroy/{id}', 'FinanceController@destroy')->name('super.finance.destroy');
        //plan
        Route::get('plan', 'PlanController@index');
        Route::post('plan/update/{id}', 'PlanController@update')->name('super.plan.update');

        //grow
        Route::get('grow', 'GrowController@index');
        Route::post('grow/update/{id}', 'GrowController@update')->name('super.grow.update');

        //firstyear
        Route::get('firstyear', 'GrowController@firstyear');

        //outlay
        Route::get('outlay', 'OutlayController@index');
        Route::post('outlay/store', 'OutlayController@store');
        Route::post('outlay/update/{id}', 'OutlayController@update')->name('user.outlay.update');
        Route::post('outlay/destroy/{id}', 'OutlayController@destroy')->name('super.outlay.destroy');

        //Competitors
        Route::get('competitors', 'CompetitorsController@index');
        Route::post('competitors/store', 'CompetitorsController@store');
        Route::post('competitors/update/{id}', 'CompetitorsController@update')->name('super.competitors.update');
        Route::post('competitors/destroy/{id}', 'CompetitorsController@destroy')->name('super.competitors.destroy');

        //target
        Route::get('target', 'TargetController@index');
        Route::post('target/store', 'TargetController@store');
        Route::post('target/update/{id}', 'TargetController@update')->name('super.target.update');
        Route::post('target/destroy/{id}', 'TargetController@destroy')->name('super.target.destroy');

        //tour
        Route::get('tour', 'TourController@index');

        //Projects
        Route::get('projects/sessionstart/{id}', 'ProjectsController@sessionstart');
        Route::get('projects/create', 'ProjectsController@create');
        Route::post('projects/store', 'ProjectsController@store');
        Route::get('projects/edit/{id}', 'ProjectsController@edit');
        Route::post('projects/update/{id}', 'ProjectsController@update')->name('super.projects.update');
        Route::delete('projects/destroy/{id}', 'ProjectsController@destroy')->name('super.projects.destroy');
        Route::get('/generate-pdf', 'PdfController@pdfview')->name('generate-pdf');

    });
});

