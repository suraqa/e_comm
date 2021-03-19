<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [PagesController::class, "index"])->name("home");

Route::resource('/product', ProductController::class);

Route::get("/add-to-cart/{product}", [CartController::class, "add"])->name("cart.add");

Route::put('/update-quantity', [CartController::class, "update"]);

Route::delete('/delete-item', [CartController::class, "destroy"]);

Route::get("/cart", [CartController::class, "show"])->name("cart.show");

Route::get('/stripe', [StripeController::class, 'stripe'])->name("stripe.get");
Route::post('/stripe', [StripeController::class, 'stripePost'])->name('stripe.post');

Route::post("/orders/add", [OrderController::class, "add"])->name("order.add");
