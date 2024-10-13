<?php
namespace App\Models;
use CodeIgniter\Model; // Asegúrate de que "Model" esté capitalizado


class CarritoModel extends Model
{

    protected $table = 'carrito';
    protected $primaryKey = 'idCarrito';
    protected $allowedFields = ['usuarioId', 'fechaCreacion', 'fechaActualizacion', 'estado'];

}