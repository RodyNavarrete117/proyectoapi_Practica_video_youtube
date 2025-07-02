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

        // Validación rápida
        if (!$request->get('nombre') || !$request->get('correo')) {
            return response()->json(['error' => 'Nombre y correo son obligatorios'], 400);
        }

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

    // Actualizar un contacto
    public function actualizar($id)
    {
        $request = app()->request();
        $contacto = Contactos::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], 404);
        }

        // Actualiza solo los campos enviados
        $contacto->nombre = $request->get('nombre', $contacto->nombre);
        $contacto->primerapellido = $request->get('primerapellido', $contacto->primerapellido);
        $contacto->segundoapellido = $request->get('segundoapellido', $contacto->segundoapellido);
        $contacto->correo = $request->get('correo', $contacto->correo);
        $contacto->save();

        return response()->json([
            'mensaje' => 'Contacto actualizado correctamente',
            'contacto' => $contacto
        ]);
    }

    // Eliminar un contacto
    public function eliminar($id)
    {
        $contacto = Contactos::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], 404);
        }

        $contacto->delete();

        return response()->json(['mensaje' => 'Contacto eliminado correctamente']);
    }
}
