<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use League\ISO3166\ISO3166;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ClientController extends Controller
{
    /**
     * Constructor: Define el middleware de autenticación para el controlador.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra una lista paginada de clientes.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los clientes paginados
        $clients = Client::paginate(10);

        // Devuelve la vista `clientes.index` con los clientes
        return view('clientes.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo cliente.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Devuelve la vista `clientes.create`
        return view('clientes.create');
    }

    /**
     * Almacena un nuevo cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'codigo' => 'required|numeric|min:0|unique:clients',
            'empresa' => 'required|max:255',
            'telefono' => 'required|numeric|unique:clients',
            'email' => 'required|max:255|unique:clients',
            'pais' => 'required|max:255',
            'direccion' => 'required|max:255',
            'picture' => 'required',
            'estado' => 'required',
        ]);

        // Crea un nuevo cliente con los datos enviados por el usuario
        Client::create([
            'picture' => $request->picture,
            'name' => $request->name,
            'codigo' => $request->codigo,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'pais' => $request->pais,
            'ciudad' => $request->ciudad ?? null,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        // Redirige al usuario a la página de listado de clientes
        return redirect()->route('client.index');
    }

    /**
     * Elimina un cliente y su imagen asociada de la base de datos y el sistema de archivos.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Client $client)
    {
        // Elimina el cliente
        $client->delete();

        // Elimina la imagen del cliente del sistema de archivos
        $imagen_path = public_path('uploads/' . $client->picture);

        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        // Redirige al usuario a la página de listado de clientes
        return redirect()->route('client.index');
    }

    /**
     * Muestra el formulario de edición de un cliente.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\View\View
     */
    public function edit(Client $client)
    {
        // Devuelve la vista `clientes.edit` con el cliente
        return view('clientes.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Actualiza los datos de un cliente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Client $client)
    {
        // Valida los datos enviados por el usuario
        $this->validate($request, [
            'name' => 'required|max:255',
            'codigo' => 'required|numeric|min:0',
            'empresa' => 'required|max:255',
            'telefono' => 'required|numeric',
            'email' => 'required|max:255',
            'pais' => 'required|max:255',
            'direccion' => 'required|max:255',
            'picture' => 'required',
            'estado' => 'required',
        ]);

        // Actualiza el cliente con los datos enviados por el usuario
        $client->name = $request->name;
        $client->codigo = $request->codigo;
        $client->empresa = $request->empresa;
        $client->telefono = $request->telefono;
        $client->email = $request->email;
        $client->picture = $request->picture;
        $client->pais = $request->pais;
        $client->estado = $request->estado;
        $client->ciudad = $request->ciudad ?? null;
        $client->direccion = $request->direccion;

        // Guarda los cambios en el cliente
        $client->save();

        // Redirige al usuario a la página de listado de clientes
        return redirect()->route('client.index');
    }

    /**
     * Muestra los detalles de un cliente específico.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\View\View
     */
    public function show(Client $client)
    {
        // Devuelve la vista `clientes.show` con el cliente
        return view('clientes.show', [
            'client' => $client,
        ]);
    }

    /**
     * Genera y descarga un PDF con el reporte de clientes.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function create_pdf()
    {
        $clients = Client::all();

        $html = view('clientes.report', [
            'clients' => $clients
        ]);

        $pdf = PDF::loadHTML($html);
        $pdf->setPaper('landscape');

        return $pdf->download('reporte_clientes.pdf');
    }

    /**
     * Genera y descarga un archivo XLSX con el reporte de clientes.
     *
     * @return void
     */
    public function create_xlsx()
    {
        $clients = Client::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Títulos
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'País');
        $sheet->setCellValue('C1', 'Ciudad');
        $sheet->setCellValue('D1', 'Dirección');
        $sheet->setCellValue('E1', 'Empresa');
        $sheet->setCellValue('F1', 'Teléfono');
        $sheet->setCellValue('G1', 'Email');

        $row = 2;

        foreach ($clients as $client) {
            $sheet->setCellValue('A' . $row, $client->name);
            $sheet->setCellValue('B' . $row, $client->pais);
            $sheet->setCellValue('C' . $row, $client->direccion);
            $sheet->setCellValue('D' . $row, $client->empresa);
            $sheet->setCellValue('E' . $row, $client->telefono);
            $sheet->setCellValue('F' . $row, $client->email);
            $row++;
        }

        // Crear el archivo y descargarlo
        $writer = new Xlsx($spreadsheet);
        $filename = 'reporte_clientes.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
