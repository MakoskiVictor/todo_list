<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Todo;
use Symfony\Component\Console\Input\Input;

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

    public function show ($id) {
        $sql = "SELECT * FROM todos WHERE id = ?";

        $todo = DB::selectOne($sql, [$id]);

        return view('todos.show', ['todo' => $todo]);
    }

    public function update (Request $request, $id) {

        $request->validate([
            'title' => 'required|min:3',
        ]);

        $sql = "UPDATE todos SET title = ?, updated_at = ? WHERE id = ?";

        $title = $request->input('title');
        $updated_at = now();

        DB::update($sql, [$title, $updated_at, $id ]);

        //dd($updated_todo);

        // return view('todos.index', ['success' => '¡Tarea actualizada!']);
        return redirect()->route('home')->with('success', '¡Tarea actualizada!');
    }

    public function destroy ($id) {
        $sql = "DELETE FROM todos WHERE id = ?";

        DB::delete($sql, [$id]);

        return redirect()->route('home')->with('success', '¡Tarea eliminada!');
    }
}
