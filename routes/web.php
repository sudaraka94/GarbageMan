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

Route::get('/', 'HomeController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
//=============================================================================================================================
//                                                        USER ROUTES
//=============================================================================================================================
    Route::group(['middleware' => 'user'], function () {
//add a garbage record
        Route::get('/add_garbage_record', ['uses' => function () {
            return view('user.add_garbage');
        }, 'as' => 'add_garbage']);

//submit garbage record
        Route::post('/add_garbage_record', ['uses' => 'user_controller@submit_record', 'as' => 'add_garbage']);

//delete garbage record
        Route::post('/delete_garbage_record', ['uses' => 'user_controller@delete_record', 'as' => 'delete_garbage']);        

//get garbage_records
        Route::get('/view_records', ['uses' => 'user_controller@view_records', 'as' => 'view_records']);

//get garbage collection records
        Route::get('/view__collection_records', ['uses' => 'user_controller@view_collection_records', 'as' => 'view__collection_records']);

//add a complaint route
        Route::get('/view_complaint', ['uses' => 'user_controller@view_complaint', 'as' => 'view_complaint']);

//post a complaint
        Route::post('/post_complaint', ['uses' => 'user_controller@post_complaint', 'as' => 'post_complaint']);

//get filed complaints
        Route::get('/get_complaints', ['uses' => 'user_controller@get_complaints', 'as' => 'get_complaints']);
        
        
    });

//=============================================================================================================================
//                                                        ADMIN ROUTES
//=============================================================================================================================
    Route::group(['middleware' => 'admin'], function () {
        
    Route::get('/admin_home', ['uses' => function () {
        return view('admin_home');
    }, 'as' => 'admin_home']);

//get filed complaints
    Route::get('/get_all_complaints', ['uses' => 'AdminController@get_all_complaints', 'as' => 'get_all_complaints']);

//get user manager
    Route::get('/manage_users', ['uses' => 'AdminController@manage_users', 'as' => 'manage_users']);

//get user edit
    Route::get('/edit_user', ['uses' => 'AdminController@get_edit_user', 'as' => 'get_user_edit']);

//submit edit user
    Route::post('/submit_edit_user', ['uses' => 'AdminController@edit_user', 'as' => 'edit_user']);

//delete a user
    Route::get('/delete_user', ['uses' => 'AdminController@delete_user', 'as' => 'delete_user']);

//post a user
    Route::post('/add_user', ['uses' => 'AdminController@add_user', 'as' => 'add_user']);

//get add user
    Route::get('/add_user', ['uses' => 'AdminController@get_add_user', 'as' => 'add_user']);
        
//get add collection point
    Route::get('/add_collection_point', ['uses' => 'AdminController@get_add_collection_point', 'as' => 'add_collection_point']);

//submit the client form
    Route::post('/add_client', ['uses' => 'AdminController@add_collection_point', 'as' => 'add_client']);

//get view colection route
        Route::get('/view_route', ['uses' => 'AdminController@view_suggestions', 'as' => 'view_route']);
        
//get edit council position
        Route::get('/edit_council_pos', ['uses' => 'AdminController@edit_council_pos', 'as' => 'edit_council_pos_get']);
        
//post edit council position        
        Route::post('/edit_council_pos', ['uses' => 'AdminController@edit_council_pos_post', 'as' => 'edit_council_pos']);

//get manage areas
        Route::get('/manage_areas', ['uses' => 'AdminController@manage_areas', 'as' => 'manage_areas']);

//get add area
        Route::get('/add_area', ['uses' => 'AdminController@add_area', 'as' => 'add_area']);

//post add area
        Route::post('/add_area', ['uses' => 'AdminController@post_add_area', 'as' => 'add_area']);
//get edit area
        Route::get('/edit_area', ['uses' => 'AdminController@get_edit_area', 'as' => 'edit_area']);
//post edit area
        Route::post('/edit_area', ['uses' => 'AdminController@edit_area', 'as' => 'edit_area']);
//delete area
        Route::get('/delete_area', ['uses' => 'AdminController@delete_area', 'as' => 'delete_area']);

//manage collection points
        Route::get('/manage_collection_points', ['uses' => 'AdminController@manage_collection_points', 'as' => 'manage_collection_points']);
//get edit client
        Route::get('/edit_collection_point', ['uses' => 'AdminController@get_edit_collection_point', 'as' => 'edit_collection_point']);
//post edit area
        Route::post('/edit_collection_point', ['uses' => 'AdminController@edit_collection_point', 'as' => 'edit_collection_point']);
//delete area
        Route::get('/delete_collection_point', ['uses' => 'AdminController@delete_collection_point', 'as' => 'delete_collection_point']);
        
    //TRUCK ROUTES
//get manage areas
        Route::get('/manage_trucks', ['uses' => 'AdminController@manage_trucks', 'as' => 'manage_trucks']);

//get add area
        Route::get('/add_truck', ['uses' => 'AdminController@add_truck', 'as' => 'add_truck']);

//post add area
        Route::post('/add_truck', ['uses' => 'AdminController@post_add_truck', 'as' => 'add_truck']);
//get edit area
        Route::get('/edit_truck', ['uses' => 'AdminController@get_edit_truck', 'as' => 'edit_truck']);
//post edit area
        Route::post('/edit_truck', ['uses' => 'AdminController@edit_truck', 'as' => 'edit_truck']);
//delete area
        Route::get('/delete_truck', ['uses' => 'AdminController@delete_truck', 'as' => 'delete_truck']);

//route for viewing calculated path
        Route::get('/view_suggestion/{area_id}', ['uses' => 'AdminController@view_path', 'as' => 'view_path']);


//These routes are used to test the algo
        Route::get('/algo_test', ['uses' => 'AdminController@area_suggestion', 'as' => 'algo_test']);

    });
});