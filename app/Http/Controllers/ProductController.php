<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de productos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los productos paginados
        $products = Product::paginate(10);

        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        // Devuelve la vista product.create con datos necesarios
        return view('product.create', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }

    /**
     * Almacena un nuevo producto en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'brand_id' => 'required',
            'picture' => 'required',
        ]);

        // Crea un nuevo producto con los datos enviados por el usuario
        Product::create([
            'picture' => $request->picture,
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
        ]);

        // Redirige al usuario a la página de listado de productos
        return redirect()->route('product.index');
    }

    /**
     * Muestra los detalles de un producto específico.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Devuelve la vista product.show con el producto
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Elimina un producto específico de la base de datos.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        // Elimina el producto
        $product->delete();
        // Elimina la imagen del producto
        $imagen_path = public_path('uploads/' . $product->picture);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }
        // Redirige al usuario a la página de listado de productos
        return redirect()->route('product.index');
    }

    /**
     * Muestra el formulario para editar un producto específico.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $brands = Brand::all();
        // Devuelve la vista product.edit con el producto y datos necesarios
        return view('product.edit', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'product' => $product,
        ]);
    }

    /**
     * Actualiza un producto específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required',
            'brand_id' => 'required',
            'picture' => 'required',
        ]);

        // Actualiza el producto con los datos enviados por el usuario
        $product->picture = $request->picture;
        $product->name = $request->name;
        $product->purchase_price = $request->purchase_price;
        $product->sale_price = $request->sale_price;
        $product->stock = $request->stock;
        $product->user_id = auth()->user()->id;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        // Guarda los cambios
        $product->save();
        // Redirige al usuario a la página de listado de productos
        return redirect()->route('product.index');
    }

    /**
     * Obtiene las subcategorías de una categoría específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubcategories(Request $request, Category $category)
    {
        $subcategories = $category->subcategories->pluck('name', 'id');

        return response()->json(['subcategories' => $subcategories]);
    }

    /**
     * Crea y descarga un archivo PDF con el inventario de productos.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function create_pdf()
    {
        $products = Product::all();

        $html = view('product.report', [
            'products' => $products,
        ]);

        $pdf = PDF::loadHTML($html);

        return $pdf->download('reporte_inventario.pdf');
    }

    /**
     * Crea y descarga un archivo XLSX con el inventario de productos.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function create_xlsx()
    {
        $products = Product::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Títulos
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'Precio de compra');
        $sheet->setCellValue('C1', 'Precio de venta');
        $sheet->setCellValue('D1', 'Stock');
        $sheet->setCellValue('E1', 'Categoria');
        $sheet->setCellValue('F1', 'Subcategoria');
        $sheet->setCellValue('G1', 'Marca');
        $sheet->setCellValue('H1', 'Agregado por');

        $row = 2;

        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->name);
            $sheet->setCellValue('B' . $row, $product->purchase_price);
            $sheet->setCellValue('C' . $row, $product->sale_price);
            $sheet->setCellValue('D' . $row, $product->stock);
            $sheet->setCellValue('E' . $row, $product->category->name);
            $sheet->setCellValue('F' . $row, $product->subcategory->name ?? "");
            $sheet->setCellValue('G' . $row, $product->brand->name);
            $sheet->setCellValue('H' . $row, $product->user->username);
            $row++;
        }

        // Crear el archivo y descargarlo
        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_inventario.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
