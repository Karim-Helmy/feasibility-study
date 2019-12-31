<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'namespace' => 'Api'], function () {
//Login and Logout
Route::post('login','UserApi@login');
Route::post('check','UserApi@check');
    Route::post('logout','UserApi@logout');

});

Route::group([ 'namespace' => 'Api','middleware' => ['study:api']], function () {





    //Team
    Route::get('team', 'TeamController@index');
    Route::post('team/store', 'TeamController@store');
    Route::post('team/update/{id}', 'TeamController@update');
    Route::post('team/destroy/{id}', 'TeamController@destroy');

    //elements
    Route::get('elements', 'ElementsController@index');
    Route::post('elements/store', 'ElementsController@store');
    Route::post('elements/update/{id}', 'ElementsController@update');
    Route::post('elements/destroy/{id}', 'ElementsController@destroy');


    //fixed
    Route::get('fixed', 'FixedController@index');
    Route::post('fixed/store', 'FixedController@store');
    Route::post('fixed/update/{id}', 'FixedController@update');
    Route::post('fixed/destroy/{id}', 'FixedController@destroy');


    //administrative
    Route::get('administrative', 'AdministrativeController@index');
    Route::post('administrative/store', 'AdministrativeController@store');
    Route::post('administrative/update/{id}', 'AdministrativeController@update');
    Route::post('administrative/destroy/{id}', 'AdministrativeController@destroy');

    //finance
    Route::get('finance', 'FinanceController@index');
    Route::post('finance/store', 'FinanceController@store');
    Route::post('finance/update/{id}', 'FinanceController@update');
    Route::post('finance/updateadvantage', 'FinanceController@updateadvantage');
    Route::post('finance/destroy/{id}', 'FinanceController@destroy');

    //plan
    Route::get('plan', 'PlanController@index');
    Route::post('plan/update/{id}', 'PlanController@update');

    //grow
    Route::get('grow', 'GrowController@index');
    Route::post('grow/update/{id}', 'GrowController@update');

    //firstyear
    Route::get('firstyear', 'GrowController@firstyear');

    //outlay
    Route::get('outlay', 'OutlayController@index');
    Route::post('outlay/store', 'OutlayController@store');
    Route::post('outlay/update/{id}', 'OutlayController@update');
    Route::post('outlay/destroy/{id}', 'OutlayController@destroy');

    //Competitors
    Route::get('competitors', 'CompetitorsController@index');
    Route::post('competitors/store', 'CompetitorsController@store');
    Route::post('competitors/update/{id}', 'CompetitorsController@update');
    Route::post('competitors/destroy/{id}', 'CompetitorsController@destroy');

    //target
    Route::get('target', 'TargetController@index');
    Route::post('target/store', 'TargetController@store');
    Route::post('target/update/{id}', 'TargetController@update');
    Route::post('target/destroy/{id}', 'TargetController@destroy');

    //Projects
    Route::get('projects', 'ProjectsController@index');
    Route::post('projects/store', 'ProjectsController@store');
    Route::get('projects/edit/{id}', 'ProjectsController@edit');
    Route::post('projects/update/{id}', 'ProjectsController@update');
    Route::delete('projects/destroy/{id}', 'ProjectsController@destroy');

});
