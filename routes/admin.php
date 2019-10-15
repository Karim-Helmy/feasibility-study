<?php
// For Language
Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
});

Route::group(['prefix' => 'admin','namespace'=>'admin'], function () {

    // Without Login
    Route::get('login', 'AdminController@login');
    Route::post('login/store', 'AdminController@store');

    // Must Login
    Route::group(['middleware' => 'admin:webAdmin'], function(){
        ######################### Admins #################################
        Route::get('admins/edit/{id}', 'AdminController@edit');
        Route::patch('admins/update/{id}', 'AdminController@update');
        Route::get('/', 'AdminController@index');
        Route::get('admins', 'AdminController@admins');
        Route::get('admins/create', 'AdminController@create');
        Route::post('admins/create', 'AdminController@save');
        Route::get('/index', 'AdminController@index');
        Route::get('/logout', 'AdminController@logout');
        Route::post('admins/destroy', 'AdminController@destroy');

        ######################### Options #################################
        Route::get('options', 'OptionsController@index');
        Route::get('options/create', 'OptionsController@create')->name('options.create');
        Route::post('options/store', 'OptionsController@store')->name('options.store');
        Route::get('options/edit/{id}', 'OptionsController@edit')->name('options.edit');
        Route::patch('options/update/{id}', 'OptionsController@update')->name('options.update');
        Route::post('options/destroy', 'OptionsController@destroy');

        ######################### Packages #################################
        Route::get('packages', 'PackagesController@index');
        Route::get('packages/show/{id}', 'PackagesController@show');
        Route::get('packages/create', 'PackagesController@create')->name('packages.create');
        Route::post('packages/store', 'PackagesController@store')->name('packages.store');
        Route::get('packages/edit/{id}', 'PackagesController@edit')->name('packages.edit');
        Route::patch('packages/update/{id}', 'PackagesController@update')->name('packages.update');
        Route::post('packages/destroy', 'PackagesController@destroy');

        ######################### Logos #################################
        Route::get('logos', 'LogosController@index');
        Route::get('logos/show/{id}', 'LogosController@show');
        Route::get('logos/create', 'LogosController@create')->name('logos.create');
        Route::post('logos/store', 'LogosController@store')->name('logos.store');
        Route::get('logos/edit/{id}', 'LogosController@edit')->name('logos.edit');
        Route::patch('logos/update/{id}', 'LogosController@update')->name('logos.update');
        Route::post('logos/destroy', 'LogosController@destroy');

        ######################### Settings #################################
        Route::resource('/settings', 'SettingsController');

        ######################### Contacts #################################
        Route::get('/contacts', 'ContactsController@index');
        Route::get('/contacts/show/{id}', 'ContactsController@show');
        Route::delete('/contacts/destroy/{id}', 'ContactsController@destroy');

        ######################### Messages #################################
        Route::get('messages', 'MessagesController@index');
        Route::get('messages/show/{sender_id?}', 'MessagesController@show');
        Route::post('messages/send/{sender_id?}', 'MessagesController@send');

        ######################### Subscriptions #################################
        Route::get('/subscribers', 'SubscribersController@index');
        Route::get('/subscribers/details', 'SubscribersController@details');
        Route::get('subscribers/active/{id}', 'SubscribersController@active');
        Route::get('subscribers/create', 'SubscribersController@create')->name('subscribers.create');
        Route::post('subscribers/store', 'SubscribersController@store')->name('subscribers.store');
        Route::get('subscribers/edit/{id}', 'SubscribersController@edit')->name('subscribers.edit');
        Route::patch('subscribers/update/{id}', 'SubscribersController@update')->name('subscribers.update');
        Route::get('subscribers/edit-password/{id}', 'SubscribersController@editPassword')->name('subscribers.password');
        Route::patch('subscribers/update-password/{id}', 'SubscribersController@updatePassword')->name('subscribers.update_password');
        Route::post('subscribers/destroy', 'SubscribersController@destroy');

        ######################### Categories #################################
        Route::get('categories', 'CategoriesController@index');
        Route::get('categories/show/{id}', 'CategoriesController@show');
        Route::get('categories/create', 'CategoriesController@create')->name('categories.create');
        Route::post('categories/store', 'CategoriesController@store')->name('categories.store');
        Route::get('categories/edit/{id}', 'CategoriesController@edit')->name('categories.edit');
        Route::patch('categories/update/{id}', 'CategoriesController@update')->name('categories.update');
        Route::post('categories/destroy', 'CategoriesController@destroy');

        //Scorms
        Route::get('scorms', 'ScormsController@index');
        Route::get('scorms/show/{id}', 'ScormsController@show');
        Route::get('scorms/create', 'ScormsController@create')->name('scorms.create');
        Route::post('scorms/store', 'ScormsController@store')->name('scorms.store');
        Route::get('scorms/edit/{id}', 'ScormsController@edit')->name('scorms.edit');
        Route::patch('scorms/update/{id}', 'ScormsController@update')->name('scorms.update');
        Route::post('scorms/destroy', 'ScormsController@destroy');

        //Photos
        Route::get('photos', 'PhotosController@index');
        Route::get('photos/create', 'PhotosController@create')->name('photos.create');
        Route::post('photos/store', 'PhotosController@store')->name('photos.store');
        Route::get('photos/edit/{id}', 'PhotosController@edit')->name('photos.edit');
        Route::patch('photos/update/{id}', 'PhotosController@update')->name('photos.update');
        Route::delete('photos/destroy/{id}', 'PhotosController@destroy')->name('photos.destroy');

        ######################### videos #################################
        Route::get('videos', 'VideosController@index');
        Route::get('videos/show/{id}', 'VideosController@show');
        Route::get('videos/create', 'VideosController@create')->name('videos.create');
        Route::post('videos/store', 'VideosController@store')->name('videos.store');
        Route::get('videos/edit/{id}', 'VideosController@edit')->name('videos.edit');
        Route::patch('videos/update/{id}', 'VideosController@update')->name('videos.update');
        Route::delete('videos/destroy/{id}', 'VideosController@destroy')->name('videos.destroy');

        ######################### attachments #################################
        Route::get('attachments', 'AttachmentsController@index');
        Route::get('attachments/show/{id}', 'AttachmentsController@show');
        Route::get('attachments/create', 'AttachmentsController@create')->name('attachments.create');
        Route::post('attachments/store', 'AttachmentsController@store')->name('attachments.store');
        Route::get('attachments/edit/{id}', 'AttachmentsController@edit')->name('attachments.edit');
        Route::patch('attachments/update/{id}', 'AttachmentsController@update')->name('attachments.update');
        Route::delete('attachments/destroy/{id}', 'AttachmentsController@destroy')->name('attachments.destroy');
    });
});
