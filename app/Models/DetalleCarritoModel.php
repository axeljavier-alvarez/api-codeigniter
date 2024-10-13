<?php
namespace App\Models;
use CodeIgniter\Model; // Asegúrate de que "Model" esté capitalizado



class DetalleCarritoModel extends Model
{

    protected $table = 'detalleCarrito';
    protected $primaryKey = 'idDetalle';

    protected $allowedFields = [
        'carritoId',
        'productoId',
        'cantidadCompra',
        'precio',
        'subTotal',
        'estado'
    ];
}