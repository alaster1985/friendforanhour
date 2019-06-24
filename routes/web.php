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
Route::get('contactToSupport', 'TicketController@index')->name('contactToSupport');
Route::post('sendTicket', 'TicketController@sendTicket')->name('sendTicket');


Route::get('lara2', function () {
    return view('welcome2');
});


Route::get('ok', function () {
    return view('allok');
})->name('ok');
Route::get('bad', function () {
    return view('allbad');
})->name('bad');
Route::get('wrong', function () {
    return view('allwrong');
})->name('wrong');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('ulogin', 'UloginController@login');
Route::get('profile', 'ProfileController@index')->name('viewProfile');

Route::middleware('auth')->group(function () {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
});

Route::middleware('role:user')->group(function () {

    Route::get('unpaid', 'MainController@unpaid')->name('unpaid');
    Route::get('banned', 'MainController@banned')->name('banned');
    Route::get('search', 'MainController@search')->name('search');

    Route::get('edit', 'ProfileController@edit')->name('editProfile');
    Route::post('getPhotos', 'ProfilePhotoController@getPhotos')->name('getPhotos');
    Route::get('mytickets', 'TicketController@mytickets')->name('mytickets');
    Route::post('payment', 'TransactionController@payment')->name('payment');

    Route::middleware('subscription', 'ban')->group(function () {

        Route::get('chat', 'ChatController@index')->name('indexChat');
        Route::get('chat/{id}', 'ChatController@show')->name('showChat');
        Route::post('chat/getChat/{id}', 'ChatController@getChat')->name('getChat');
        Route::post('chat/sendChat', 'ChatController@sendChat')->name('sendChat');
        Route::post('addToFriends', 'FriendController@store')->name('addToFriends');
        Route::post('removePhoto', 'ProfilePhotoController@removePhoto')->name('removePhoto');
        Route::post('updatePhoto', 'ProfilePhotoController@updatePhoto')->name('updatePhoto');
        Route::post('addComplain', 'ProfileController@addComplain')->name('addComplain');
        Route::post('update', 'ProfileController@update')->name('updateProfile');
        Route::get('deleteService/{id}', 'ServiceListController@deleteService')->name('deleteService');
        Route::post('filter', 'ProfileController@filter')->name('filter');

    });

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

    Route::get('admin/viewTickets', 'Admin\AdminController@viewTickets')->name('viewTickets');
    Route::get('admin/editTicket', 'Admin\AdminController@editTicket')->name('editTicket');
    Route::get('admin/acceptTicket', 'Admin\AdminController@acceptTicket')->name('acceptTicket');
    Route::post('admin/updateTicket', 'Admin\AdminController@updateTicket')->name('updateTicket');

    Route::get('admin/viewProfileBans', 'Admin\BanController@viewProfileBans')->name('viewProfileBans');
    Route::get('admin/viewBanList', 'Admin\BanController@viewBanList')->name('viewBanList');
    Route::post('admin/addBan', 'Admin\BanController@addBan')->name('addBan');
    Route::get('admin/editBan', 'Admin\BanController@editBan')->name('editBan');
    Route::post('admin/updateBan', 'Admin\BanController@updateBan')->name('updateBan');

    Route::get('admin/viewSubscriptionList', 'TransactionController@viewSubscriptionList')->name('viewSubscriptionList');
    Route::get('admin/viewProfileTransactions', 'TransactionController@viewProfileTransactions')->name('viewProfileTransactions');

});
