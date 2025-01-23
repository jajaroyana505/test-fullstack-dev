<?php

use App\Http\Controllers\Api\ChartController;
use App\Http\Controllers\Api\FetchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return json_encode("Welcom to API");
});

Route::get('/chart/gender', [ChartController::class, 'gender'])->name('api.chart.gender');
Route::get('/chart/dob', [ChartController::class, 'dob'])->name('api.chart.dob');
Route::get('/fetch/peoples', [FetchController::class, 'peoples'])->name('api.fetch.peoples');
