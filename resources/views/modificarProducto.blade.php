@extends('layouts.plantilla')

@section('contenido')


        <h1>Modificacion de un producto existente</h1> 

        <div class="alert bg-light border border-white shadow round col-8 mx-auto p-4">

            <form action="/modificarProducto" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                Nombre: <br>
                <input type="text" name="prdNombre" value="{{old('prdNombre', $Producto->prdNombre)}}" class="form-control">
                <br>
                Precio: <br>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input type="number" name="prdPrecio" value="{{old('prdPrecio', $Producto->prdPrecio)}}" class="form-control">
                </div>
                <br>
                Marca: <br>
                <select name="idMarca" class="form-control">
                    <option value="{{$Producto->idMarca}}">{{$Producto->relMarca->mkNombre}}</option>
                @foreach ($marcas as $marca)
                    <option {{($marca->idMarca==old('idMarca'))?'selected':''}} value="{{$marca->idMarca}}">{{$marca->mkNombre}}</option>
                @endforeach
                </select>
                <br>
                Categoría: <br>
                <select name="idCategoria" class="form-control">
                    <option value="{{$Producto->idCategoria}}">{{$Producto->relCategoria->catNombre}}</option>
                @foreach ($categorias as $categoria)
                    <option {{($categoria->idCategoria==old('idCategoria'))?'selected':''}} value="{{$categoria->idCategoria}}">{{$categoria->catNombre}}</option>
                @endforeach
                </select>
                <br>
                Presentacion: <br>
                <textarea name="prdPresentacion" class="form-control">{{old('prdPresentacion', $Producto->prdPresentacion)}}</textarea>

                <label for="prdStock">Stock:</label>
                <input type="number" name="prdStock" id="prdStock" value="{{old('prdStock', $Producto->prdStock)}}" class="form-control" min="0">
                
                <label for="prdImagen">Imagen nueva (opcional)</label>
                <div class="custom-file mt-1 mb-4">
                    <input type="file" name="prdImagen"  class="custom-file-input" id="customFileLang" lang="es">
                    <label class="custom-file-label" for="customFileLang" data-browse="Buscar en disco">Seleccionar Archivo: </label>
                </div>

                <br>
                <button class="btn btn-dark mb-3">Modificar producto</button>
                <a href="/adminProductos" class="btn btn-outline-secondary mb-3">Volver al panel de Productos</a>
            </form>

        </div>
        
        @if( $errors->any() )
            <div class="alert alert-danger col-8 mx-auto p-2">
                <ul>
                    @foreach( $errors->all() as $error )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


@endsection
