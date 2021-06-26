@extends('layouts.plantilla')

    @section('contenido')

        <h1>Panel de administración de productos</h1>

        @if ( session('mensaje') )
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif

        <table class="table table-borderless table-striped table-hover">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Presentación</th>
                    <th>Imagen</th>
                    <th colspan="2">
                        <a href="/agregarProducto" class="btn btn-outline-secondary">
                            Agregar
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
        @foreach ($productos -> $producto)
                <tr>
                    <td>    {{$productos->prdNombre}}                   </td>
                    <td>    {{$productos->relMarca->mkNombre}}          </td>
                    <td>    {{$productos->relCategoria->catNombre}}     </td>
                    <td>    {{$productos->prdPrecio}}                   </td>
                    <td>    {{$productos->prdPresentacion}}             </td>
                    <td>    {{$productos->prdImagen}}                   </td>
                    <td>    
                        <a href="/modificarProducto" class="btn btn-outline-secondary">
                            Modificar
                        </a>
                    </td>
                    <td>
                        <a href="/eliminarProducto" class="btn btn-outline-secondary">
                            Eliminar
                        </a>
                    </td>
                </tr>
            

            </tbody>
        </table>


    @endsection
