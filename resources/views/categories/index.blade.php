@extends('app')

@section('content')
    <div class=" container w-25 border p-4 my-4 " >
        <div class="row mx-auto" >
            <form action="{{ route('categories.store') }}" method="POST">
                {{-- Usamos csrf para evitar que el usuario pueda forzar acciones no permitidas (evita que una pagina desconocida pueda hacer cambios) --}}
                @csrf
                {{-- Uso de if else con Blaze --}}
                @if (@session('success'))
                    <h6 class=" alert alert-success " > {{ session('success') }} </h6>   
                @endif
                @error('name')
                <h6 class=" alert alert-danger " > {{ $message }} </h6> 
                @enderror
                <div class="mb-3">
                <label for="name" class="form-label">Ingrese nombre de la Categoría</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                @error('color')
                <h6 class=" alert alert-danger " > {{ $message }} </h6> 
                @enderror
                <div class="mb-3">
                <label for="color" class="form-label">Ingrese color de la Categoría</label>
                <input type="color" name="color" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                <button type="submit" class="btn btn-primary">Agregar categoría</button>
            </form>

            <div>
                @foreach ($categories as $category)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id]) }}">
                            <span class="color-container" style="background-color: {{ $category->color }}"></span> {{ $category->name }}
                        </a>
                    </div>

                    <!-- Button trigger modal -->
                    <div class="col-md-3 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{$category->id}}">Eliminar</button>
                        
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que desea borrar la categoría? El proceso es irreversible
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{route('categories.destroy', ['category' => $category->id])}}" method="POST" >
                            @method('DELETE')
                            @csrf
                        </form>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                    </div>
                </div>
                </div>
                    
                @endforeach
            </div>
        </div>
    </div>
@endsection