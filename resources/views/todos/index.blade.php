{{-- Muestro donde está la plantilla padre --}}
@extends('app')
{{-- Muestro el nombre de la sección (yield) --}}
@section('content')
    <div class="container w-25 border p-4 mt-4 ">
        <form action="{{ route('agregar') }}" method="POST">
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
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Cargar</button>
        </form>

        <div>
            @foreach ($todos as $todo)
                <div class=" row py-1 " >
                    <div class=" col-md-9 d-flex align-items-center " >
                        <a href=" {{ route('todos-update', ['id' => $todo->id]) }} "> {{ $todo->title }} </a>
                    </div>
                </div>

                <div class=" col-md-3 d-flex justify-content-end " >
                    <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class=" btn btn-danger btn-sm ">Eliminar</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
{{-- Siempre que abro una section, debo cerrarla --}}
@endsection