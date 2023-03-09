<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RedirectController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('restaurants', RestaurantController::class);
    Route::resource('products', ProductController::class);

    // Rotta che reindirizza alla pagina show del ristorante dell'utente loggato
    Route::get('/restaurant', function () {
        return redirect()->route('admin.restaurants.show', Auth::user()->restaurant);
    });

    Route::resource('orders', OrderController::class);

    // Rotta che indirizza al frontoffice dal backoffice
    Route::get('/backoffice-to-frontoffice', [RedirectController::class, 'redirectToFrontOffice'])->name('backoffice-to-frontoffice');
});

require __DIR__ . '/auth.php';
