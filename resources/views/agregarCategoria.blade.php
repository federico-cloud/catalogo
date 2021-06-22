@extends('layouts.plantilla')

    @section('contenido')

        <h1>Alta de una nueva Categoria</h1>

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/agregarCategoria" method="post">
                @csrf
                <div class="form-group">
                    <label for="catNombre">Nombre de la categoria</label>
                    <input type="text" name="catNombre" value="{{old('catNombre')}}" class="form-control" id="catNombre">
                </div>
                <button class="btn btn-dark mr-3">Agregar categoria</button>
                <a href="/adminMarcas" class="btn btn-outline-secondary">
                    Volver a panel de categorias
                </a>
            </form>
            
        </div>

        @if ($errors->any())
        <div class="alert alert-danger col-8 mx-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    @endsection
