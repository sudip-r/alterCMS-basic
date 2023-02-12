<?php

use App\Http\Controllers\alterCMS\API\APIController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

$router->get('/', 'HomeController@index')->name('dashboard');

$router->get('dashboard', 'HomeController@index')->name('adminDashboard');

$router->get('logger', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

$router->get('logout', function () {
  Auth::logout();
  return back();
})->name('logout');

/* ==================================================================================
                            API
===================================================================================*/
$router->post('/update-dark-mode', [APIController::class, 'toggleDarkMode'])->name('toggle.dark-mode');

/* ==================================================================================
                        Role Module
 ====================================================================================*/

$router->get('user/roles', 'User\RoleController@index')->name('users.roles.index');

$router->get('user/role/create', 'User\RoleController@create')->name('users.roles.create');

$router->post('user/role/store', 'User\RoleController@store')->name('users.roles.store');

$router->get('user/role/edit/{role}', 'User\RoleController@edit')->name('users.roles.edit');

$router->patch('user/role/update/{role}', 'User\RoleController@update')->name('users.roles.update');

$router->get('user/roles/permissions/{role}', 'User\RoleController@permissions')->name('users.roles.permissions');

$router->post('user/roles/permission/update/{role}', 'User\RoleController@updatePermissions')->name('users.roles.permissions.update');

/* ==================================================================================
                        User Module
 ====================================================================================*/

$router->get('users', 'User\UserController@index')->name('users.index');

$router->get('users/create', 'User\UserController@create')->name('users.create');

$router->post('users/store', 'User\UserController@store')->name('users.store');

$router->get('users/edit/{user}', 'User\UserController@edit')->name('users.edit');

$router->patch('users/update/{user}', 'User\UserController@update')->name('users.update');

$router->get('user/verification/check/{token}', 'User\UserController@verify')->name('users.verification.check');


/* ==================================================================================
                        Category Module
 ====================================================================================*/

//  $router->get('categories', 'Category\CategoryController@index')->name('categories.index');

// $router->get('categories/add', 'Category\CategoryController@create')->name('categories.create');

// $router->get('categories/edit/{category}', 'Category\CategoryController@edit')->name('categories.edit');

// $router->delete('categories/delete/{category}', 'Category\CategoryController@delete')->name('categories.delete');

// $router->patch('categories/update/{category}', 'Category\CategoryController@update')->name('categories.update');

// $router->post('categories/store','Category\CategoryController@store')->name('categories.store');