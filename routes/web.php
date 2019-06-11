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

Route::get('/', 'MainController@index')->name('index');
Route::get('lara2', function () {return view('welcome2');});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('ulogin', 'UloginController@login');
Route::get('profile', 'ProfileController@index')->name('viewProfile');

Route::middleware('auth')->group(function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('role:user')->group(function () {

    Route::get('edit', 'ProfileController@edit')->name('editProfile');
    Route::post('update', 'ProfileController@update')->name('updateProfile');
    Route::get('deleteService/{id}', 'ServiceListController@deleteService')->name('deleteService');
    Route::post('getPhotos', 'ProfilePhotoController@getPhotos')->name('getPhotos');
    Route::post('removePhoto', 'ProfilePhotoController@removePhoto')->name('removePhoto');
    Route::post('updatePhoto', 'ProfilePhotoController@updatePhoto')->name('updatePhoto');
    Route::post('addComplain', 'ProfileController@addComplain')->name('addComplain');
    Route::get('chat', 'ChatController@index')->name('indexChat');
    Route::get('chat/{id}', 'ChatController@show')->name('showChat');
    Route::post('chat/getChat/{id}', 'ChatController@getChat')->name('getChat');
    Route::post('chat/sendChat', 'ChatController@sendChat')->name('sendChat');
    Route::post('addToFriends', 'FriendController@store')->name('addToFriends');

});

Route::middleware('role:admin|moderator')->group(function () {

    Route::get('admin/dashboard', 'Admin\AdminController@dashboard')->name('dashboard');

    Route::get('admin/viewAdminUsers', 'Admin\AdminController@viewAdminUsers')->name('viewAdminUsers');
    Route::get('admin/deleteAdminUser/{id}', 'Admin\AdminController@deleteAdminUser')->name('deleteAdminUser');
    Route::get('admin/editAdminUser', 'Admin\AdminController@editAdminUser')->name('editAdminUser');
    Route::post('admin/updateAdminUser', 'Admin\AdminController@updateAdminUser')->name('updateAdminUser');
    Route::get('admin/createAdminUser', 'Admin\AdminController@createAdminUser')->name('createAdminUser');
    Route::post('admin/addAdminUser', 'Admin\AdminController@addAdminUser')->name('addAdminUser');

    Route::get('admin/viewProfileUsers', 'Admin\AdminController@viewProfileUsers')->name('viewProfileUsers');
    Route::get('admin/editProfileUser', 'Admin\AdminController@editProfileUser')->name('editProfileUser');
    Route::post('admin/updateProfileUser', 'Admin\AdminController@updateProfileUser')->name('updateProfileUser');

    Route::post('admin/getPhotos', 'ProfilePhotoController@getPhotos')->name('getPhotos');
    Route::post('admin/removePhoto', 'ProfilePhotoController@removePhoto')->name('removePhoto');
    Route::post('admin/updatePhoto', 'ProfilePhotoController@updatePhoto')->name('updatePhoto');
});
