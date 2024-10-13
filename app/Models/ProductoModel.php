<?php 
namespace App\Models;
use CodeIgniter\Model; // Asegúrate de que "Model" esté capitalizado


class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'idProducto';

    protected $allowedFields = ['nombre', 'descripcion', 'precio', 'stock', 'imagen', 'estado', 'tipoProductoId'];

    protected $validationRules = [

        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        /*'imagen' => 'required', */
        /* 'estado' => 'required', */
        'tipoProductoId' => 'required|integer'
    ];
}