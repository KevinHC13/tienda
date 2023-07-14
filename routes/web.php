<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\ProviderController;
=======
use App\Http\Controllers\CategoryController;
>>>>>>> fcb3e9edfc6ee033f41c56cda349a1416f5211bf
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SubcategoryController;
use Yajra\DataTables\Html\Editor\Editor;

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

Route::get('/ventas', function () {
    return view('venta.index');
})->name('venta.index');

Route::get('/ventas/detalles', function () {
    return view('venta.show');
})->name('venta.show');

Route::get('/devoluciones', function () {
    return view('devolucion.index');
})->name('devolucion.index');

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


Route::get('/provider', [ProviderController::class,'index'])->name('provider.index');
Route::get('/provider/create', [ProviderController::class, 'create'])->name('provider.create');
Route::post('/provider', [ProviderController::class, 'store'])->name('provider.store');
Route::delete('/provider/{provider}',[ProviderController::class, 'destroy'])->name('provider.destroy');
Route::get('/provider/{provider}/edit',[ProviderController::class, 'edit'])->name('provider.edit');
Route::put('/provider/{provider}', [ProviderController::class, 'update'])->name('provider.update');
Route::get('/provider/{provider}', [ProviderController::class,'show'])->name('provider.show');

//Rutas Clientes
Route::get('/client',[ClientController::class,'index'])->name('client.index');
Route::get('/client/create',[ClientController::class,'create'])->name('client.create');
Route::post('/client',[ClientController::class,'store'])->name('client.store');
Route::delete('/client/{client}',[ClientController::class,'destroy'])->name('client.destroy');
Route::get('/client/{client}/edit',[ClientController::class,'edit'])->name('client.edit');
Route::put('/client/{client}',[ClientController::class,'update'])->name('client.update');
Route::get('/client/{client}',[ClientController::class,'show'])->name('client.show');

Route::post('/imagenes',[ImagesController::class, 'store'])->name('imagenes.store');

