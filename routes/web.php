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

});

Route::middleware('role:admin|moderator')->group(function () {
    Route::get('admin/dashboard', 'Admin\AdminController@dashboard')->name('dashboard');
});
