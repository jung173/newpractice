<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('products.index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // 商品一覧
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    // 商品新規作成画面
    Route::get('/products/create', [ProductController::class, 'create'])
        ->name('products.create');

    // 商品保存処理（POST）
    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    // 商品詳細
    Route::get('/products/{id}', [ProductController::class, 'show'])
        ->name('products.show');

    // 商品削除
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
        ->name('products.destroy');
    
    // 商品編集画面
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    // 商品更新
    Route::put('/products/{id}', [ProductController::class, 'update'])
        ->name('products.update');
});

require __DIR__.'/auth.php';