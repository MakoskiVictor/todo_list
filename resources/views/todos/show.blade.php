{{-- Muestro donde está la plantilla padre --}}
@extends('app')
{{-- Muestro el nombre de la sección (yield) --}}
@section('content')
    <div class="container w-25 border p-4 mt-4 ">
        <form action="{{ route('todos-patch', ['id' => $todo->id]) }}" method="POST">
            @method('PATCH')
            {{-- Usamos csrf para evitar que el usuario pueda forzar acciones no permitidas (evita que una pagina desconocida pueda hacer cambios) --}}
            @csrf
            {{-- Uso de if else con Blaze --}}
            @if (@session('success'))
                <h6 class=" alert alert-success " > {{ session('success') }} </h6>   
            @endif
            @error('title')
            <h6 class=" alert alert-danger " > {{ $message }} </h6> 
            @enderror
            <div class="mb-3">
            <label for="title" class="form-label">Ingrese Tarea</label>
            <input 
                type="text" 
                name="title" 
                class="form-control" 
                id="exampleInputEmail1" 
                aria-describedby="emailHelp"
                value="{{ $todo->title }}"
            >
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>

    </div>
{{-- Siempre que abro una section, debo cerrarla --}}
@endsection