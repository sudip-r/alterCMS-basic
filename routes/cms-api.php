<?php 
namespace App\Providers;

use App\Http\Controllers\alterCMS\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/get-messages', [UserController::class, 'getMessage'])->name('get.messages');

// Route::get('/get-messages', [UserController::class, 'getMessage'])->name('get.messages');


