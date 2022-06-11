<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\pariwisata_CategoriController;
use App\Http\Controllers\pariwisata_DestinasiController;
use App\Http\Controllers\pariwisata_ImageCarousel;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [UsersController::class,'login']);
    Route::post('logout', [UsersController::class,'logout']);
    Route::get('me', [UsersController::class,'me']);
    Route::get('user_all', [UsersController::class,'user_all']);
    Route::post('register', [UsersController::class,'register']);
});

Route::group(['prefix' => 'pariwisata'], function () {
    Route::group(['prefix' => 'carousel'], function() {
        Route::get('show', [pariwisata_ImageCarousel::class,'show']);
        Route::post('add', [pariwisata_ImageCarousel::class,'add']);
    });

    Route::group(['prefix' => 'destinasi'], function() {
        Route::post('add', [pariwisata_DestinasiController::class,'add']);
        Route::post('add_details', [pariwisata_DestinasiController::class,'add_details']);
        Route::get('show_header', [pariwisata_DestinasiController::class,'show_header']);
        Route::post('show_header_detail', [pariwisata_DestinasiController::class,'show_header_detail']);
    });

    Route::group(['prefix' => 'categori'], function() {
        Route::post('add', [pariwisata_CategoriController::class,'add']);
        Route::post('change_status', [pariwisata_CategoriController::class,'change_status']);
        Route::get('show', [pariwisata_CategoriController::class,'show']);
    });
});
