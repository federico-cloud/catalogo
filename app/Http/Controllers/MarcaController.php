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
            $marcas = Marca::all();

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
                                            'mkNombre.required' =>  "El nombre de la marca egis obligatorio",
                                            'mkNombre.min'      =>  "El nombre de la marca debe tener al menos 2 caracteres"    
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
        //Instanciacion, asignacion, guardar dato
            $Marca = new Marca;
            $Marca -> mkNombre = $mkNombre;
            $Marca -> save();
        //Redireccion mas mensajes
            return redirect('adminMarcas')
                                ->with   (
                                            [
                                                'mensaje' => 'Marca: '.$mkNombre.' dada de alta correctamente'
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
    public function edit($idMarca)
    {
        //Obtenemos datos de una marca
            $Marca = Marca::find($idMarca);
        //Retornamos vista con datos
            return view ('modificarMarca',
                            [
                                'Marca' => $Marca
                            ]
                        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Caputramos datos
            $mkNombre = $request-> mkNombre;
        //Validacion
            $this->validarForm($request);
        //Obtenemos una marca por su ID
            $Marca = Marca::find($request->idMarca);
        //Modificamos los/el atributos 
            $Marca->mkNombre = $mkNombre;
        //Guardar
            $Marca->save();
        //Redirigmos con el mensaje ok
            return redirect('adminMarcas')
                ->with  (
                            [
                                'mensaje' => 'Marca: '.$mkNombre.' modificada correctamente'
                            ]
                        );
    }

    private function productoPorMarca($idMarca)
    {
        //$check = Producto::where('idMarca', $idMarca)->first();
        //$check = Producto::fiirstWhere('idMarca', $idMarca);
        $check = Producto::where('idMarca')->count();
        return $check;
    }

    public function confirmarBaja() 
    {
        //Obtenemos datos de una marca por ID
            $Marca::find($idMarca);
        ## chequear si no hay un producto de esa marca
        if($this->productoPorMarca($idMarca) == 0)
        {
            //Retornar vista con datos de la confirmacion
            return 'vista con datos para la confirmacion de la baja';
        }
        return 'redireccion con mensaje que no se puede borrar';
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
