<?php

use App\Http\Controllers\API\AdController;
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

//Объявления
Route::group(['prefix' => 'ad', 'as' => 'ad.'], function () {
    Route::get('/', [AdController::class, 'index'])->name('index');
    Route::post('/', [AdController::class, 'post'])->name('post');
    Route::get('all', [AdController::class, 'all'])->name('all');
    Route::get('{model:id}', [AdController::class, 'get'])->name('get');
});
