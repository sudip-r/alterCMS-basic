<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () { 
  dd('Hi');
})->name('dashboard');

Route::get('/dashboard', function () { 
  dd('Hi');
})->name('dashboard');

