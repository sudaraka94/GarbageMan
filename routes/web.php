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

Route::get('/', ['uses'=>function () {
    return view('home');
},'as'=>'home']);



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
        Route::get('/view_route', ['uses' => 'AdminController@view_route', 'as' => 'view_route']);
        
//get edit council position
        Route::get('/edit_council_pos', ['uses' => 'AdminController@edit_council_pos', 'as' => 'edit_council_pos']);
        
//post edit council position        
        Route::post('/edit_council_pos', ['uses' => 'AdminController@edit_council_pos_post', 'as' => 'edit_council_pos']);


    });
});