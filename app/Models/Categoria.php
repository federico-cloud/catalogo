<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    //protected $table = 'nuevas_marcas';
    public $timestamps = false;
    //Cambia la primaryKey que es id por el que se indique
    protected $primaryKey = 'idCategoria';

}
