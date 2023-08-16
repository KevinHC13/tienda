<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ImportController extends Controller
{
    public function create()
    {
        return view('import.create');
    }

    public function store(Request $request)
    {
        // Validar y manejar la carga del archivo CSV
        if ($request->file('archivo_csv')) {
            $path = $request->file('archivo_csv')->getRealPath();
            $contenido = file_get_contents($path);

            
            // Lectura de contenido línea por línea:
            $lineas = explode("\n", $contenido);
            
            // Omitir la primera línea (encabezados)
            array_shift($lineas);

            foreach ($lineas as $linea) {
                $campos = str_getcsv($linea);

                // Verificar si la línea tiene suficientes campos
            if (count($campos) >= 7) {
                $product = Product::create([
                    'name' => $campos[0],
                    'purchase_price' => intval($campos[1]),
                    'sale_price' => intval($campos[2]),
                    'stock' => $campos[3],
                    'picture' => "",
                    'user_id' => auth()->user()->id,
                    'category_id' => $campos[4],
                    'brand_id' => $campos[6],
                ]);

                if(!($campos[5] == "")){
                    $product->subcategory_id = intval($campos[5]);
                    $product->save();
                }
            }
                // Aquí puedes realizar operaciones con los campos de cada línea.
            }

            return redirect()->route('product.index');
        }

        return response()->json(['messaje' => 'no se agregaron productos', 'error' => 'Debe añadir un producto']);
    }



    public function download()
    {
        $csvContent = "name,purchase_price,sale_price,stock,picture,category_id,subcategory_id,brand_id\nDante2,123,333,4,null,2,null,1,\n"; // Contenido de ejemplo

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data.csv"',
        ];

        return Response::make($csvContent, 200, $headers);
    }
}
