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

Route::get('/', 'WelcomeController@index')->name('welcome.index');

// Login/Registration Handling
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('mypage', 'MypageController', ['only' => ['index']]);
    
    //*-- eventsController --*//
    Route::get('events/schedule', 'EventsController@showScheduleGroupEvent')->name('events.showScheduleGroupEvent');
    Route::get('events/schedule-private', 'EventsController@showSchedulePrivateEvent')->name('events.showSchedulePrivateEvent');
    Route::post('events/schedule', 'EventsController@scheduleGroupEvent')->name('events.scheduleGroupEvent');
    Route::post('events/schedule-private', 'EventsController@schedulePrivateEvent')->name('events.schedulePrivateEvent');
    Route::resource('events', 'EventsController', ['only' => ['index', 'show']]);
    
    Route::resource('friends', 'FriendsController', ['only' => ['show','store','delete','index']]);
    Route::get('search', 'SearchController@index')->name('friends.search');
    // Group表示はフレンドの方に含める
    Route::resource('groups', 'GroupsController', ['only' => ['show','store','delete','index']]);
    // 友達検索機能のコントローラ
    Route::resource('user', 'UserController');
    Route::resource('makegroup', 'MakegroupController', ['only' => ['index','store', 'destroy']]);
    Route::get('add/{id}', 'AddFriendController@store')->name('add.get');
    Route::delete('unfriend/{id}','AddFriendController@destroy')->name('unfriend');
    //Settingsのコントローラー
     Route::get('settings', 'SettingsController@index')->name('settings.settings');
      Route::get('settings/theme', 'SettingsController@changeTheme')->name('settings.changeTheme');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
