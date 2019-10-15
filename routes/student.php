<?php
// For Language
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});
Auth::routes();
Route::group(['prefix' => 'student','namespace'=>'student'], function () {


    // Must Login
    Route::group(['middleware' => ['Student', 'auth']], function(){
        //Home
        Route::get('/home', 'HomeController@index');
        //Edit And Show Profile
        Route::get('/show', 'ProfileController@show');
        Route::get('/edit', 'ProfileController@edit');
        Route::patch('/update', 'ProfileController@update')->name('student.user.update');
    });
});
