<?php

use App\Http\Controllers\API\GridController;
use App\Http\Controllers\API\RecordController;
use App\Http\Controllers\API\UnsplashController;
use App\Http\Controllers\ScreenController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');


Route::group(['prefix' => 'screen', 'as' => 'screen.'], function () {
    Route::get('one', [ScreenController::class, 'screenOne'])->name('one.index');
    Route::get('two', [ScreenController::class, 'screenTwo'])->name('two.index');
    Route::get('three', [ScreenController::class, 'screenThree'])->name('three.index');
});


Route::group(['prefix' => 'api'], function () {
    Route::get('records/search', [RecordController::class, 'search']);
    Route::get('unsplash', [UnsplashController::class, 'search']);
    Route::get('grid', [GridController::class, 'getInitialState']);
    Route::post('grid', [GridController::class, 'updateState']);
});
