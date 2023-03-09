<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RestaurantController;
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

// creo rotta (/api/restaurants) che restituisca tutti i dati dei ristoranti in formato JSON
Route::get('restaurants', [RestaurantController::class, 'index']);

// rotta /api/restaurants/nome-ristorante-città-codice-postale (slug d'esempio)
Route::get('restaurants/{slug}', [RestaurantController::class, 'show']);

//rotta /api/orders
Route::post('/orders', [OrderController::class, 'store']);