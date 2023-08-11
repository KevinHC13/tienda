<?php

use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Html\Editor\Editor;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsarioController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProvedorController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;

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

Route::get('/ventas/detalles', function () {
    return view('venta.show');
})->name('venta.show');

Route::get('/devoluciones', function () {
    return view('devolucion.index');
})->name('devolucion.index');

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
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


//Rutas provedores
Route::get('/provedor',[ProvedorController::class,'index'])->name('provedor.index');
Route::get('/provedor/create',[ProvedorController::class,'create'])->name('provedor.create');
Route::post('/provedor',[ProvedorController::class,'store'])->name('provedor.store');
Route::delete('/provedor/{provedor}',[ProvedorController::class,'destroy'])->name('provedor.destroy');
Route::get('/provedor/{provedor}/edit',[ProvedorController::class,'edit'])->name('provedor.edit');
Route::put('/provedor/{provedor}',[ProvedorController::class,'update'])->name('provedor.update');
Route::get('/provedor/{provedor}',[ProvedorController::class,'show'])->name('provedor.show');

//Rutas usuarios
Route::get('/user',[UserController::class,'index'])->name('user.index');
Route::get('/user/create',[UserController::class,'create'])->name('user.create');
Route::post('/user',[UserController::class,'store'])->name('user.store');
Route::delete('/user/{user}',[UserController::class,'destroy'])->name('user.destroy');
Route::get('/user/{user}/edit',[UserController::class,'edit'])->name('user.edit');
Route::put('/user/{user}',[UserController::class,'update'])->name('user.update');
Route::get('/user/{user}',[UserController::class,'show'])->name('user.show');

//Rutas usuarios
Route::get('/purchase',[PurchaseController::class,'index'])->name('purchase.index');
Route::get('/purchase/create',[PurchaseController::class,'create'])->name('purchase.create');
Route::post('/purchase',[PurchaseController::class,'store'])->name('purchase.store');
Route::delete('/purchase/{purchase}',[PurchaseController::class,'destroy'])->name('purchase.destroy');
Route::get('/purchase/{purchase}/edit',[PurchaseController::class,'edit'])->name('purchase.edit');
Route::put('/purchase/{purchase}',[PurchaseController::class,'update'])->name('purchase.update');
Route::get('/purchase/{purchase}',[PurchaseController::class,'show'])->name('purchase.show');

Route::post('/purchase/addproduct', [PurchaseController::class, 'addProduct']);


//Rutas ventas
Route::get('/sale',[SalesController::class,'index'])->name('sale.index');
Route::get('/sale/create',[SalesController::class,'create'])->name('sale.create');


Route::post('/imagenes',[ImagesController::class, 'store'])->name('imagenes.store');

Route::get('/product/subcategory/{category}', [ProductController::class, 'getSubcategories']);
