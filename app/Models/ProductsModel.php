<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    // Tabla
    protected $table      = 'products';
    protected $primaryKey = 'id';

    // Pasar los campos de la tabla
    protected $allowedFields = ['name', 'description', 'price', 'stock'];

    protected $validationRules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
    ];
}
