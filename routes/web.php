<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('logout', function () {
  Auth::guard('web')->logout();
  Auth::guard('business')->logout();
  Auth::guard('client')->logout();
  Auth::logout();
  return back();
})->name('logout');

Route::post('/login/user', [App\Http\Controllers\Auth\LoginController::class, 'alterLogin'])->name('post.alter.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
