<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'BusinessController@index')->name('dashboard');

Route::get('/dashboard', 'BusinessController@index')->name('dashboard');

Route::get('/profile', 'BusinessController@profile')->name('profile');

Route::post('/profile/information', 'BusinessController@updateInformation')->name('profile.information');

Route::post('/profile/images', 'BusinessController@updateImages')->name('profile.images');

Route::post('/profile/description', 'BusinessController@updateDescription')->name('profile.description');


