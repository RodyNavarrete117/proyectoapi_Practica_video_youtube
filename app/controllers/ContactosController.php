<?php

namespace App\Controllers;

use App\Models\Contactos;
use Leaf\Controller;

class ContactosController extends Controller
{
    // Obtener todos los registros
    public function index()
    {
        $datosContactos = Contactos::all();
        return response()->json($datosContactos);
    }

    // Consultar un contacto por ID
    public function consultar($id)
    {
        $contacto = Contactos::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], 404);
        }

        return response()->json($contacto);
    }

    // Agregar nuevo contacto
    public function agregar()
    {
        $request = app()->request();

        $contacto = new Contactos;
        $contacto->nombre = $request->get('nombre');
        $contacto->primerapellido = $request->get('primerapellido');
        $contacto->segundoapellido = $request->get('segundoapellido');
        $contacto->correo = $request->get('correo');
        $contacto->save();

        return response()->json([
            'mensaje' => 'Contacto agregado correctamente',
            'contacto' => $contacto
        ], 201);
    }
}
