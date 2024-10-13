<?php

namespace App\Controllers;
use App\Models\TipoProductoModel;

use CodeIgniter\Controller;


class AgregarTipoProducto extends Controller {


    protected $model;

    public function __construct() {
        $this->model = new TipoProductoModel();
    }

    public function index(){
        $tipoProducto = $this->model->findAll();
        return view('agregar_tipoproducto', ['tipoProducto'=> $tipoProducto]);
    }
}