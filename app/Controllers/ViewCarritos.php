<?php
namespace App\Controllers;
use App\Models\DetalleCarritoModel;
use CodeIgniter\Controller;

class ViewCarritos extends Controller {
    protected $model;

    public function __construct() {
        $this->model = new DetalleCarritoModel();
    }


    public function index(){
        $detallecarrito = $this->model->findAll();
        return view( 'ver_carrito', ['detallecarrito' => $detallecarrito]);
    }
}