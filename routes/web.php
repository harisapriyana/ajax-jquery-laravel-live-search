<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    $products = Product::orderBy('name', 'asc')->paginate(5);
    return view('index', compact('products'));
});

Route::resource('/product', ProductController::class);
Route::post('/product/search', [ProductController::class, 'search']);
// Route::get('/product/search/{query}', [ProductController::class, 'search']);



