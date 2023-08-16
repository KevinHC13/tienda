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
<<<<<<< HEAD
use App\Http\Controllers\ImportController;
=======
use App\Http\Controllers\CotizacionController;
>>>>>>> 13c7648caf3a7acca2b96373cc3b65bcf46af53f
use App\Http\Controllers\ProvedorController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\QuotesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use App\Models\Client;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Returns;
use App\Models\Sales;

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
    $clients = Client::all();
    return view('clientes.report',[
        'clients' => $clients
    ]);
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
Route::get('/productPdf', [ProductController::class, 'create_pdf'])->name('product.create_pdf');
Route::get('/productXlsx', [ProductController::class, 'create_xlsx'])->name('product.create_xlsx');


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

Route::get('/clientPdf',[ClientController::class, 'create_pdf'])->name('client.create_pdf');
Route::get('/clientXlsx',[ClientController::class, 'create_xlsx'])->name('client.create_xlsx');


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

//Rutas compras
Route::get('/purchase',[PurchaseController::class,'index'])->name('purchase.index');
Route::get('/purchase/create',[PurchaseController::class,'create'])->name('purchase.create');
Route::post('/purchase',[PurchaseController::class,'store'])->name('purchase.store');
Route::delete('/purchase/{purchase}',[PurchaseController::class,'destroy'])->name('purchase.destroy');
Route::get('/purchase/{purchase}/edit',[PurchaseController::class,'edit'])->name('purchase.edit');
Route::put('/purchase/{purchase}',[PurchaseController::class,'update'])->name('purchase.update');
Route::get('/purchase/{purchase}',[PurchaseController::class,'show'])->name('purchase.show');

<<<<<<< HEAD
Route::get('/purchasePdf', [PurchaseController::class,'create_pdf'])->name('purchase.create_pdf');
Route::get('/purchaseXlsx', [PurchaseController::class,'create_xlsx'])->name('purchase.create_xlsx');

Route::post('/purchase/addproduct', [PurchaseController::class, 'addProduct']);
=======
//Rutas de cotizacion
Route::get('/cotizacion',[CotizacionController::class,'index'])->name('cotizacion.index');
Route::get('/cotizacion/create',[CotizacionController::class,'create'])->name('cotizacion.create');
Route::post('/cotizacion',[CotizacionController::class,'store'])->name('cotizacion.store');
Route::delete('/cotizacion/{cotizacion}',[CotizacionController::class,'destroy'])->name('cotizacion.destroy');
Route::get('/cotizacion/{cotizacion}/edit',[CotizacionController::class,'edit'])->name('cotizacion.edit');
Route::put('/cotizacion/{cotizacion}',[CotizacionController::class,'update'])->name('cotizacion.update');
Route::get('/cotizacion/{cotizacion}',[CotizacionController::class,'show'])->name('cotizacion.show');
>>>>>>> 13c7648caf3a7acca2b96373cc3b65bcf46af53f


//Rutas ventas
Route::get('/sale',[SalesController::class,'index'])->name('sale.index');
Route::get('/sale/create',[SalesController::class,'create'])->name('sale.create');
<<<<<<< HEAD
Route::post('/sale/getProducts', [SalesController::class, 'getProducts']);
Route::post('/sale', [SalesController::class, 'store']);
Route::get('/sale/{sale}', [SalesController::class, 'show'])->name('sale.show');
Route::get('/salePdf', [SalesController::class, 'create_pdf'])->name('sale.create_pdf');
Route::get('/saleXlsx', [SalesController::class, 'create_xlsx'])->name('sale.create_xlsx');

// Rutas para tickets
Route::get('/ticket/pdf/{sale}',[TicketController::class, 'create_pdf'])->name('ticket.pdf');
Route::get('/ticket/xlsx/{sale}',[TicketController::class, 'exportXlsx'])->name('ticket.exportXlsx');

// Rutas para las devoluciones
Route::get('/returns',[ReturnsController::class,'index'])->name('returns.index');
Route::get('/returns/create/{sale}', [ReturnsController::class, 'create'])->name('returns.create');
Route::get('/returns/{return}', [ReturnsController::class, 'show'])->name('returns.show');
Route::post('/returns', [ReturnsController::class, 'store']);

Route::get('/returnsPdf', [ReturnsController::class, 'create_pdf'])->name('returns.create_pdf');
Route::get('/returnsXlsx', [ReturnsController::class, 'create_xlsx'])->name('returns.create_xlsx');

// Rutas para cotizaciones
Route::get('/quotes', [QuotesController::class, 'index'])->name('quotes.index');
Route::get('/quotes/create', [QuotesController::class, 'create'])->name('quotes.create');
Route::post('/quotes', [QuotesController::class, 'store']);
Route::get('/quotes/{quote}', [QuotesController::class, 'show'])->name('quotes.show');
Route::get('/quotes/exportXlsx/{quote}',[QuotesController::class, 'exportXlsx'])->name('quotes.exportXlsx');
=======

>>>>>>> 13c7648caf3a7acca2b96373cc3b65bcf46af53f

Route::post('/imagenes',[ImagesController::class, 'store'])->name('imagenes.store');

Route::get('/product/subcategory/{category}', [ProductController::class, 'getSubcategories']);


// Importacion de productos
Route::get('/import/create', [ImportController::class,'create'])->name('import.create');
Route::post('/import', [ImportController::class,'store'])->name('import.store');
Route::get('/import/download', [ImportController::class,'download'])->name('import.download');