<?php
// For Language
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});
Auth::routes();
Route::group(['prefix' => 'user','namespace'=>'super'], function () {


    // Must Login
    Route::group(['middleware' => ['Supervisor', 'auth']], function(){
        //Home
        Route::get('/home', 'HomeController@index');
        //Subscriber (Edit Home page to all)
        Route::get('/school/edit', 'SubscribersController@edit');
        Route::patch('/school/update/{id}', 'SubscribersController@update')->name('super.school.update');

        //Edit And Show Profile
        Route::get('/show', 'ProfileController@show');
        Route::get('/edit', 'ProfileController@edit');
        Route::patch('/update', 'ProfileController@update')->name('super.user.update');

        //Messages
        Route::get('messages', 'MessagesController@index');
        Route::get('messages/show/{sender_id?}', 'MessagesController@show');
        Route::post('messages/send/{sender_id?}', 'MessagesController@send');


        //Users
        Route::get('users', 'UsersController@index');
        Route::get('users/excel', 'UsersController@excel');
        Route::post('users/import', 'UsersController@import');
        Route::get('users/create', 'UsersController@create');
        Route::post('users/store', 'UsersController@store');
        Route::get('users/edit/{id}', 'UsersController@edit');
        Route::patch('users/update/{id}', 'UsersController@update')->name('super.users.update');
        Route::delete('users/destroy/{id}', 'UsersController@destroy')->name('super.users.destroy');


        //Courses
        Route::get('courses', 'CoursesController@index');
        Route::get('courses/create', 'CoursesController@create');
        Route::post('courses/store', 'CoursesController@store');
        Route::get('courses/edit/{id}', 'CoursesController@edit');
        Route::post('courses/update/{id}', 'CoursesController@update')->name('super.courses.update');
        Route::delete('courses/destroy/{id}', 'CoursesController@destroy')->name('super.courses.destroy');
        Route::post('courses/assignuser', 'CoursesController@courseuser');

    });
});
