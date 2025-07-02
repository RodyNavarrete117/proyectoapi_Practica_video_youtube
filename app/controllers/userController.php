<?php

namespace App\Controllers;

use App\Models\User;
use Leafs\Http\Request;
use Leafs\Http\Response;

class UserController
{
    public function create(Request $request, Response $response)
    {
        $data = $request->post();

        // Validar datos básicos (puedes usar validación más avanzada)
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            return $response->json(['error' => 'Missing required fields'], 400);
        }

        // Verificar si email ya existe
        if (User::where('email', $data['email'])->first()) {
            return $response->json(['error' => 'Email already exists'], 409);
        }

        // Crear usuario
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];  // Se encripta automáticamente con setPasswordAttribute
        $user->save();

        return $response->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
}
