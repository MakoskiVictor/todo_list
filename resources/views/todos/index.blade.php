{{-- Muestro donde está la plantilla padre --}}
@extends('app')
{{-- Muestro el nombre de la sección (yield) --}}
@section('content')
    <div class="container w-25 border p-4 mt-4 ">
        <form>
            <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ingrese Tarea</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Cargar</button>
        </form>
    </div>
{{-- Siempre que abro una section, debo cerrarla --}}
@endsection