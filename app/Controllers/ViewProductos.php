<?php
namespace App\Controllers;
use App\Models\ProductoModel;
use CodeIgniter\Controller;



class ViewProductos extends Controller {

    protected $model;

    public function __construct() {
        $this->model = new ProductoModel();
    }

    public function index(){
        $producto = $this->model->findAll();
        return view ('ver_producto');
    }

}