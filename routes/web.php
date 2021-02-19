<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PicoPlacaController;


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

Route::get('/', [PicoPlacaController::class, 'index'])->name('index');

Route::match(['get', 'post'], 'predict', [PicoPlacaController::class, 'predictPicoPlaca'])->name('predict');
