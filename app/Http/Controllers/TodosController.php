<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;

class TodosController extends Controller
{
    /*
        Convenciones de Laravel:

        index para mostrar todos los ToDos
        store para guardar un ToDo
        update para actualizar
        destroy para eliminar
        edit para mostrar el formulario de edición
    */
    public function store(Request $request){
        // Validaciones:
        $request->validate([
            'title' => 'required|min:3',
        ]);

        // Construyo la query sql
        $title = $request->input('title');
        $created_at = now();
        $updated_at = now();
        $sql = "INSERT INTO todos (title, created_at, updated_at) VALUES (?, ?, ?)";
        // $sql = "INSERT INTO todos (title) VALUES (?)";

        // Ejecutar la consulta sql
        DB::insert($sql, [$title, $created_at, $updated_at]);

        // Redirigir una vez concluido el trámite con éxito
        return redirect()->route('home')->with('success', '¡Tarea creada exitosamente!');
    }

    public function index() {
        $sql = "SELECT * FROM todos";

        $todos = DB::select($sql);


        return view('todos.index', ['todos' => $todos]);

    }
}
