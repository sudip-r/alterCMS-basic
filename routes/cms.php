<?php

use App\Http\Controllers\alterCMS\API\APIController;
use App\Http\Controllers\alterCMS\HomeController;
use App\Http\Controllers\alterCMS\Setting\SettingController;
use App\Http\Controllers\alterCMS\User\RoleController;
use App\Http\Controllers\alterCMS\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

/*
|--------------------------------------------------------------------------
| CMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register cms routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
 */

/* ==================================================================================
Dashboard
===================================================================================*/

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('logger', [LogViewerController::class, 'index']);

Route::get('logout', function () {
    Auth::logout();
    return back();
})->name('logout');

/* ==================================================================================
API
===================================================================================*/
Route::post('/update-dark-mode', [APIController::class, 'toggleDarkMode'])->name('toggle.dark-mode');

/* ==================================================================================
Role Module
====================================================================================*/

Route::get('user/roles', [RoleController::class, 'index'])->name('users.roles.index');

Route::get('user/role/create', [RoleController::class, 'create'])->name('users.roles.create');

Route::post('user/role/store', [RoleController::class, 'store'])->name('users.roles.store');

Route::get('user/role/edit/{role}', [RoleController::class, 'edit'])->name('users.roles.edit');

Route::patch('user/role/update/{role}', [RoleController::class, 'update'])->name('users.roles.update');

Route::get('user/roles/permissions/{role}', [RoleController::class, 'permissions'])->name('users.roles.permissions');

Route::post('user/roles/permission/update/{role}', [RoleController::class, 'updatePermissions'])->name('users.roles.permissions.update');

/* ==================================================================================
User Module
====================================================================================*/

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('users/create', [UserController::class, 'create'])->name('users.create');

Route::post('users/store', [UserController::class, 'store'])->name('users.store');

Route::get('users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');

Route::patch('users/update/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('user/verification/check/{token}', [UserController::class, 'verify'])->name('users.verification.check');

/* ==================================================================================
Setting Module
====================================================================================*/
Route::get('profile/user-setting', [SettingController::class, 'setting'])->name('profile.setting');

Route::patch('profile/user-setting/{setting}', [SettingController::class, 'updateSetting'])->name('profile.setting.update');

Route::get('messages', [SettingController::class, 'messages'])->name('messages.message');

Route::patch('message/{message}', [SettingController::class, 'sendMessage'])->name('messages.message.send');

/* ==================================================================================
Category Module
====================================================================================*/

//  Route::get('categories', 'Category\CategoryController@index')->name('categories.index');

// Route::get('categories/add', 'Category\CategoryController@create')->name('categories.create');

// Route::get('categories/edit/{category}', 'Category\CategoryController@edit')->name('categories.edit');

// Route::delete('categories/delete/{category}', 'Category\CategoryController@delete')->name('categories.delete');

// Route::patch('categories/update/{category}', 'Category\CategoryController@update')->name('categories.update');

// Route::post('categories/store','Category\CategoryController@store')->name('categories.store');
