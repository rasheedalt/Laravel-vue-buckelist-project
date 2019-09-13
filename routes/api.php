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


Route::post('auth/register', 'LoginController@register');
Route::post('auth/logout', 'LoginController@logout');

Route::post('auth/login', 'LoginController@login');
Route::group(['middleware' => 'jwt.auth'], function(){
  Route::get('auth/user', 'LoginController@user');
});
Route::group(['middleware' => 'jwt.refresh'], function(){
  Route::get('auth/refresh', 'LoginController@refresh');
});

                 /* BUCKETLIST */

//CREATES A NEW BUCKETLIST
Route::post('bucketlists', 'BucketlistController@create');

//Lists all the created bucketlists
Route::post('bucketlistss', 'BucketlistController@index');

//Get a single bucketlist
Route::get('bucketlists/{id}', 'BucketlistController@single');

//Update a single bucketlist
Route::post('bucketlists/{id}', 'BucketlistController@update'); //put

// Delete a bucketlist
Route::delete('bucketlists/{id}', 'BucketlistController@delete');

//Search 
Route::get('bucketlist', 'BucketlistController@search');


         /* ITEMS */

//Create a new item in a bucketlist
Route::post('bucketlists/{id}/item', 'ItemController@create');

//List all the created items in a bucketlist
Route::get('bucketlists/{id}/items/', 'ItemController@list');

//Get a single item in a bucketlist
Route::get('bucketlists/{id}/items/{item_id}', 'ItemController@single');

//Update a bucketlist item
Route::post('bucketlists/{id}/items/{item_id}', 'ItemController@update'); 

//Delete an item in a bucketlist
Route::delete('item/{item_id}', 'ItemController@delete');
