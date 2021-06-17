<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos el listado de las marcas
            $marcas = Marca::paginate(5);

        //Retornamos la vista con el listado
            return view (
                            'adminMarcas',
                            [
                                'marcas' => $marcas
                            ]
                        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('agregarMarca');
    }

    private function validarForm(Request $request)
    {
        $request = $request
                        ->validate  (
                                        [
                                            'mkNombre' => 'required | min:2'
                                        ],
                                        [
                                            'mkNombre.required' => "El nombre de la marca egis obligatorio",
                                            'mkNombre.min' => "El nombre de la marca debe tener al menos 2 caracteres"    
                                        ]
                                    );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Caputramos el dato del formulario agregarMarca
            $mkNombre = $request -> mkNombre;
        //Validamos el dato
            $this->validarForm($request);
        //Instanciacion, asignacion, guardar el

        //Redireccion mas mensajes
            return 'Retornamos validacion';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
