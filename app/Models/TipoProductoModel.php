<?php 
namespace App\Models;

use CodeIgniter\Model;


class TipoProductoModel extends Model
{
    protected $table = 'tipoProducto';
    protected $primaryKey = 'idTipoProducto';

    protected $allowedFields = ['nombre','descripcion','estado'];

    /* VALIDAR QUE ELEMENTOS SON OBLIGATORIOS SON OBLIGATORIOS O NO NULOS */
    protected $validationRules = [
        'nombre' => 'required',
        'descripcion' => 'required',
    ];

}


