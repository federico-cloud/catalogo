<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtenemos el listado de categorias
            $categorias = Categoria::all();

        //Retornamos vista con listado de categorias    
            return view (
                            'adminCategorias',
                            [
                                'categorias' => $categorias
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
        return view (
                    'agregarCategoria'
                    );
    }


    private function validarForm(Request $request)
    {
        $request = $request
                        ->validate  (
                                        [    
                                            'catNombre' => 'required | min:5'
                                        ],
                                        [
                                            'catNombre.min'         =>  'El nombre de la categoria debe tener al menos 5 caracteres.',
                                            'catNombre.required'    =>  'El nombre de la categoria es obligatorio.'
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
        //Capturamos el dato del formulario
            $catNombre = $request->catNombre;
        //Validamos el dato del formulario
            $this->validarForm($request);
        //Instanciacion, asignacion y guardar el objeto
            $Categoria = new Categoria;
            $Categoria -> catNombre = $catNombre;
            $Categoria -> save();
        //Redireccion con mensaje
            return redirect ('adminCategorias')
                                ->with  (
                                            [
                                                'mensaje' => 'Categoria: '.$catNombre.' dada de alta correctamente'
                                            ]
                                        );
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
