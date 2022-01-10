<?php

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

Route::resource('users', 'UsersController')->middleware('role:admin,manager');
Route::resource('post', 'PostController');
Route::resource('roles', 'RoleController')->middleware('can:isAdmin');
Route::resource('permissions', 'PermissionController');


Route::get('user_all', 'UsersController@get_all_users')->name('user.get_all_users');


Route::get('layout', function() {
    return view('layout');
});

Route::get('dash/', function() {
    return view('dash');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/newlogin', function () {
    return view('auth.newlogin');
});