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

Route::post('getAllProfiles', 'ProfileController@getAllProfiles')->name('getAllProfiles');

Route::get('lara2', function () { return view('welcome2');});

Route::get('ok', 'MainController@ok')->name('ok');
Route::get('bad', 'MainController@bad')->name('bad');
Route::get('payment', 'TransactionController@payment')->name('payment');

Route::get('wrong', function () {return view('allwrong');})->name('wrong');

Route::get('search', 'MainController@search')->name('search');
Route::post('filter', 'ProfileController@filter')->name('filter');

Route::get('news', 'MainController@newsIndex')->name('news');
Route::get('newsView', 'NewsController@newsView')->name('newsView');
Route::get('articles', 'MainController@articlesIndex')->name('articles');
Route::get('articlesView', 'ArticleController@articlesView')->name('articlesView');

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

    Route::get('edit', 'ProfileController@edit')->name('editProfile');
    Route::post('setProfileLocation', 'ProfileController@setProfileLocation')->name('setProfileLocation');
    Route::post('getPhotos', 'ProfilePhotoController@getPhotos')->name('getPhotos');
    Route::get('mytickets', 'TicketController@mytickets')->name('mytickets');

    Route::get('favorites', 'FavoriteController@index')->name('favorites');
    Route::get('blacklist', 'BlackListController@index')->name('blacklist');

    Route::middleware('subscription', 'ban')->group(function () {

        Route::get('chat', 'ChatController@index')->name('indexChat');
        Route::get('chat/{id}', 'ChatController@show')->name('showChat');
        Route::post('chat/getChat/{id}', 'ChatController@getChat')->name('getChat');
        Route::post('chat/sendChat', 'ChatController@sendChat')->name('sendChat');
        Route::get('chat/setReadMark/{id}', 'ChatController@setReadMark')->name('setReadMark');
        Route::get('checkUnreadMessagesFromFriend/{id}', 'ChatController@checkUnreadMessagesFromFriend')->name('checkUnreadMessagesFromFriend');
        Route::get('checkMyUnreadMessagesByFriend/{id}', 'ChatController@checkMyUnreadMessagesByFriend')->name('checkMyUnreadMessagesByFriend');
        Route::post('addToFriends', 'FriendController@store')->name('addToFriends');
        Route::post('removePhoto', 'ProfilePhotoController@removePhoto')->name('removePhoto');
        Route::post('updatePhoto', 'ProfilePhotoController@updatePhoto')->name('updatePhoto');
        Route::post('addComplain', 'ProfileController@addComplain')->name('addComplain');
        Route::post('addToFavorite', 'FavoriteController@addToFavorite')->name('addToFavorite');
        Route::post('addToBlackList', 'BlackListController@addToBlackList')->name('addToBlackList');
        Route::get('deleteFromFavorite/{id}', 'FavoriteController@deleteFromFavorite')->name('deleteFromFavorite');
        Route::get('deleteFromBlackList/{id}', 'BlackListController@deleteFromBlackList')->name('deleteFromBlackList');
        Route::post('update', 'ProfileController@update')->name('updateProfile');
        Route::get('deleteService/{id}', 'ServiceListController@deleteService')->name('deleteService');

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
    Route::get('admin/detailTransaction', 'TransactionController@detailTransaction')->name('detailTransaction');
    Route::post('admin/addTransaction', 'TransactionController@addTransaction')->name('addTransaction');

    Route::get('admin/viewNews', 'NewsController@viewNews')->name('viewNews');
    Route::get('admin/editNews', 'NewsController@editNews')->name('editNews');
    Route::get('admin/createNews', 'NewsController@createNews')->name('createNews');
    Route::post('admin/updateNews', 'NewsController@updateNews')->name('updateNews');
    Route::post('admin/addNews', 'NewsController@addNews')->name('addNews');

    Route::get('admin/viewArticles', 'ArticleController@viewArticles')->name('viewArticles');
    Route::get('admin/editArticles', 'ArticleController@editArticles')->name('editArticles');
    Route::get('admin/createArticles', 'ArticleController@createArticles')->name('createArticles');
    Route::post('admin/updateArticles', 'ArticleController@updateArticles')->name('updateArticles');
    Route::post('admin/addArticles', 'ArticleController@addArticles')->name('addArticles');

});
