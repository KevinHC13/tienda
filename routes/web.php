<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubcategoryController;
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
    return view('dashboard');
})->name('dashboard');

Route::get('/user/create', [RegisterController::class, 'create'])->name('user.create');
Route::post('/user', [RegisterController::class, 'store'])->name('user.store');
Route::get('/user/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/user/login',[LoginController::class, 'store']);

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/{category}',[CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{category}', [CategoryController::class,'show'])->name('category.show');


Route::get('/subcategory',[SubcategoryController::class, 'index'])->name('subcategory.index');
Route::get('/subcategory/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
Route::post('/subcategory', [SubcategoryController::class, 'store'])->name('subcategory.store');
Route::delete('/subcategory/{subcategory}',[SubcategoryController::class, 'destroy'])->name('subcategory.destroy');
Route::get('/subcategory/{subcategory}/edit',[SubcategoryController::class, 'edit'])->name('subcategory.edit');
Route::put('/subcategory/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategory.update');
Route::get('/subcategory/{subcategory}', [SubcategoryController::class,'show'])->name('subcategory.show');



Route::get('/brand',[BrandController::class, 'index'])->name('brand.index');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
Route::delete('/brand/{brand}',[BrandController::class, 'destroy'])->name('brand.destroy');
Route::get('/brand/{brand}/edit',[BrandController::class, 'edit'])->name('brand.edit');
Route::put('/brand/{brand}', [BrandController::class, 'update'])->name('brand.update');
Route::get('/brand/{brand}', [BrandController::class,'show'])->name('brand.show');


Route::get('/product',[ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/{product}',[ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/{product}/edit',[ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{product}', [ProductController::class,'show'])->name('product.show');


Route::post('/imagenes',[ImagesController::class, 'store'])->name('imagenes.store');


