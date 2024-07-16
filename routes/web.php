<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TodosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/todos', function () {
//     return 'Hola a todos desde esta ruta';
// });
Route::get('/', function () {
    return redirect()->route('todos.index');
})->name('home');
//Route::get('/todos', [TodosController::class, 'index'])->name('todos.index'); // Para mostrar todos los ToDos

Route::get('/tareas', [TodosController::class, 'index'])->name('todos.index');

Route::post('/agregar', [TodosController::class, 'store'])->name('agregar'); // Toma más relevancia al name que a la route para llamar a la fn

Route::get('/tareas-mostrar/{id}', [TodosController::class, 'show'])->name('todos-update');

Route::patch('/tareas-editar/{id}', [TodosController::class, 'update'])->name('todos-patch');

Route::delete('/tareas-borrar/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

// Agregar todas las rutas de un controller

Route::resource('categories', CategoriesController::class);