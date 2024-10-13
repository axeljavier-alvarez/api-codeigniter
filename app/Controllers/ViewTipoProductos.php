<?php 
namespace App\Controllers;
use App\Models\TipoProductoModel;
use CodeIgniter\Controller;


class ViewTipoProductos extends Controller {
    protected $model;

    public function __construct()
    {
        $this->model = new TipoProductoModel();
    }

    /* Nuevo index */
    public function index(){
        $tipoProducto = $this->model->findAll();
        return view( 'ver_tipoProducto', ['tipoProducto' => $tipoProducto]);
    }
}
