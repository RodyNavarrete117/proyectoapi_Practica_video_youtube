<?php

app()->get("/", function () {
    response()->json(["message" => "Hola Develoteca"]);
});

// Consulta todos los registros (Verbo GET)
app()->get("/contactos", 'ContactosController@index');
// Consulta un registro con un ID (Verbo GET)
app()->get("/contactos/{id}", 'ContactosController@consultar');
// Inserta un registro (Verbo POST)
app()->post("/contactos", 'ContactosController@agregar');
// Borra un registro (Verbo DELETE)
app()->delete("/contactos/{id}", 'ContactosController@borrar');

// Borra un registro (Verbo PUT)
app()->put("/contactos/{id}", 'ContactosController@actualizarDatos');