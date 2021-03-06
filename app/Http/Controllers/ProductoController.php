<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getAll(){
        //Obtenemos el listado de productos
        $productos = Producto::with('relMarca', 'relCategoria')->paginate(6);
        
        //Retornamos la vista
        return view('portada', [
                                    'productos' => $productos
                                ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('relMarca','relCategoria')->paginate(6);

        //Obtenemos los datos con los productos
        $productos = Producto::paginate(4);

        //Retornamos la vista con la lista de productos
        return view('adminProductos', ['productos' => $productos]);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtenemos listado de marcas y categorias
        $marcas = Marca::all();
        $categorias = Categoria::all();
        //retornamos vista
        return view('agregarProducto', [
                                            'marcas' => $marcas,
                                            'categorias' => $categorias
                                        ]
        );
    }

    public function validarForm(Request $request)
    {
        $request -> validate(
                                [
                                    'prdNombre'                 =>  'required|min:3|max:70',
                                    'prdPrecio'                 =>  'required|numeric|min:0',
                                    'idMarca'                   =>  'required',
                                    'idCategoria'               =>  'required',
                                    'prdPresentacion'           =>  'required|min:3|max:150',
                                    'prdStock'                  =>  'required|integer|min:1',
                                    'prdImagen'                 =>  'mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
                                ],
                                [
                                    'prdNombre.required'        =>  'Complete el campo Nombre',
                                    'prdNombre.min'             =>  'Complete el campo Nombre con al menos 3 caract??res',
                                    'prdNombre.max'             =>  'Complete el campo Nombre con 70 caract??res como m??xino',
                                    'prdPrecio.required'        =>  'Complete el campo Precio',
                                    'prdPrecio.numeric'         =>  'Complete el campo Precio con un n??mero',
                                    'prdPrecio.min'             =>  'Complete el campo Precio con un n??mero positivo',
                                    'idMarca.required'          =>  'Selecciona una marca',
                                    'idCategoria.required'      =>  'Selecciona una categor??a',
                                    'prdPresentacion.required'  =>  'Complete el campo Presentaci??n',
                                    'prdPresentacion.min'       =>  'Complete el campo Presentaci??n con al menos 3 caract??res',
                                    'prdPresentacion.max'       =>  'Complete el campo Presentaci??n con 150 caract??rescomo m??xino',
                                    'prdStock.required'         =>  'Complete el campo Stock',
                                    'prdStock.integer'          =>  'Complete el campo Stock con un n??mero entero',
                                    'prdStock.min'              =>  'Complete el campo Stock con un n??mero positivo',
                                    'prdImagen.mimes'           =>  'Debe ser una imagen',
                                    'prdImagen.max'             =>  'Debe ser una imagen de 2MB como m??ximo'
                                ]
        );

    }

    private function subirImagen(Request $request)
    {

        //Si no envian un archivo metodo store()
        $prdImagen = 'noDisponible.jpg';

        //Si no enviaron archivo metodo update()
        if($request->has('imagenOriginal'))
        {
            $prdImagen = $request->imagenOriginal;
        }
        //Si enviaron una imagen SUBIR ARCHIVO
        if ($request->file('prdImagen'))
        {
            //renombrar
            $ext = $request->file('prdImagen')->extension();
            $prdImagen = time().'.'.$ext;
            //subir
            $request->file('prdImagen')->move(public_path('productos/'), $prdImagen);
        }
        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prdNombre = $request->prdNombre;
        //Validacion
        $this->validarForm($request);
        //Subir Imagen
        $prdImagen = $this->subirImagen($request);
        //Instanciar, asignar, guardar
        $Producto = new Producto;

        $Producto->prdNombre        =   $prdNombre;
        $Producto->prdPrecio        =   $request->prdPrecio;
        $Producto->idMarca          =   $request->idMarca;
        $Producto->idCategoria      =   $request->idCategoria;
        $Producto->prdPresentacion  =   $request->prdPresentacion;
        $Producto->prdStock         =   $request->prdStock;

        $Producto->save();

        return redirect('adminProductos')
                                ->with(
                                        [
                                            'mensaje' => 'Producto '.$prdNombre.' agregado con exito',
                                        ]
                                );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {
        //Obtenemos los datos del producto, categorias y marcas
        $Producto = Producto::with('relMarca', 'relCategoria')->find($idProducto);
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('modificarProducto', [
                                            'Producto'      =>  $Producto,
                                            'categorias'    =>  $categorias,
                                            'marcas'        =>  $marcas
                                        ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Capturamos el dato para flashearlo
        $prdNombre          = $request->prdNombre;
        
        //Validamos los datos del formulario
        //Validamos datos
        $this->validarForm($request);
        //Validamos imagen * si fue enviada
        $prdImagen = $this->subirImagen($request);
        
        //Obtenemos el producto por el ID
        $Producto = Producto::find($request->idProducto);

        //Modificamos los datos
        $Producto -> prdNombre          = $prdNombre;
        $Producto -> prdPrecio          = $request->prdPrecio;
        $Producto -> idMarca            = $request->idMarca;  
        $Producto -> idCategoria        = $request->idCategoria;
        $Producto -> prdPresentacion    = $request->prdPresentacion;
        $Producto -> prdStock           = $request->prdStock;
        $Producto -> prdImagen          = $prdImagen;

        //Guardamos en BD
        $Producto->save();

        //Redireccionamos con el mensaje OK
        return redirect("adminProductos")
            ->with(
                    [
                        'mensaje' => 'El producto '.$prdNombre.' fue modificada correctamente'
                    ]
            );
    }

    public function confirmarBaja($idProducto) 
    {
        $Producto = Producto::with('relMarca', 'relCategoria')->find($idProducto);

        return view('eliminarProducto', [
                                            'Producto' => $Producto
                                        ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //Capturamos los datos
        $prdNombre = $request->prdNombre;
        $idProducto= $request->idProducto;

        //Borramos de la BD
        Producto::destroy($idProducto);

        return redirect('/adminProductos')
            ->with(
                    [
                        'mensaje' => 'Producto: '.$prdNombre.' eliminado correctamente'
                    ]
            );


    }
}
