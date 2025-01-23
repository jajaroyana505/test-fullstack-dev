<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeopleController;

use Illuminate\Support\Facades\Route;



Route::get('/',  [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/peoples', PeopleController::class);
Route::get('/people/search', [PeopleController::class, 'search'])->name('search');
