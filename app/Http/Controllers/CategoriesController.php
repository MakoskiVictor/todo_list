<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "SELECT * FROM categories";

        $categories = DB::select($sql);

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$sql = "INSERT INTO categories";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7'
        ]);

        $sql = "INSERT INTO categories ( id, name, color, created_at, updated_at ) VALUES (?, ?, ?, ?, ?)";

        $uuid = Uuid::uuid4()->toString();
        $name = $request->input('name');
        $color = $request->input('color');
        $created_at = now();
        $updated_at = now();

        DB::insert($sql, [$uuid, $name, $color, $created_at, $updated_at]);

        return redirect()->route('categories.index')->with('success', '¡Categoría creada!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";

        $category_show = DB::selectOne($sql, [$category]);

        return view('categories.show', ['category' => $category_show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'color' => 'required|max:7'
        ]);

        $sql = "UPDATE categories ( name, color, updated_at ) VALUES (?, ?, ?) WHERE id = ?";

        $name = $request->input('name');
        $color = $request->input('color');
        $updated_at = now();

        DB::insert($sql, [$name, $color, $updated_at, $category]);

        return redirect()->route('categories.index')->with('success', '¡Categoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $sql = "DELETE FROM categories WHERE id = ?";

        DB::delete($sql, [$category]);

        return redirect()->route('categories.index')->with('success', '¡Categoría borrada!');

    }
}
