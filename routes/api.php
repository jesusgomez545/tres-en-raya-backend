<?php

use Illuminate\Http\Request;

use App\Round;
use App\Movement;

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

Route::post('rounds', 'RoundController@store');
Route::post('movements', 'MovementController@store');
