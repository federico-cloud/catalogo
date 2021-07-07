@extends('layouts.plantilla')

    @section('contenido')

        <h1>Catálogo de productos</h1>

        <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-lg-4">

            @foreach($productos as $producto)

                <div class="col-12">

                    <div class="card">
                        <img src="/productos/{{ $producto->prdImagen }}" class="card-img-top img-thumbnail">
                        <div class="card-body">
                            <h2 class="card-title">{{ $producto->prdNombre }}</h2>
                            <div class="card-text">
                                <h5>MARCA:</h5>    
                                <p>{{$producto->relMarca->mkNombre}}</p>
                                <h5>CATEGORIA:</h5>
                                <p>{{$producto->relCategoria->catNombre}}</p>
                                <h5>PRECIO:</h5>
                                <p>${{ $producto->prdPrecio}}</p>
                                <h5>PRESENTACION:</h5>
                                <p>{{ $producto->prdPresentacion}}</p>
                            </div>
                        </div>
                    </div>

                </div>

            @endforeach

        </div>
        {{ $productos->links() }}

    @endsection

