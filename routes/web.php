<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('posts','PostController@index')->middleware(['auth'])->name('posts');
Route::post('posts/bookmark','PostController@bookmarkpost')->middleware(['auth']);

require __DIR__.'/auth.php';

//Admin
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        //login
        Route::get('login','AuthenticatedSessionController@create')->name('login');
        Route::post('login','AuthenticatedSessionController@store')->name('adminlogin');
    });
    Route::middleware('admin')->group(function () {
        Route::get('dashboard','HomeController@index')->name('dashboard');

        Route::get('post','PostController@index')->name('post');
        Route::get('post/create','PostController@create')->name('post.create');
        Route::post('post','PostController@store')->name('admin.post');
        Route::get('post/destroy/{id}','PostController@destroy'); 
        Route::get('post/edit/{id}','PostController@edit'); 
        Route::post('post/update/{id}','PostController@update');

        //Route::resource('post', 'PostController');
    });    
    Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');
});
Route::post('logout','Auth\AuthenticatedSessionController@destroy')->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('songs','SongsController@index')->name('songs');
    Route::get('mysongs','SongsController@mysongs')->name('my.songs');
    Route::get('song/add','SongsController@add')->name('song.add');
    Route::post('song/store','SongsController@store')->name('song.store');
    Route::get('song/edit/{id}','SongsController@edit');
    Route::get('song/view/{id}','SongsController@view'); 
    Route::post('song/update/{id}','SongsController@update');
    Route::get('song/destroy/{id}','SongsController@destroy');

    //profile
    Route::get('public_profile/{id}','ProfileController@publicProfile')->name('public.profile');
    Route::post('profile/subscribe','ProfileController@profileSubscribe')->name('profile.subscribe');
});
