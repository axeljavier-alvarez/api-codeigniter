<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;


class ViewUsuarios extends Controller {
    protected $model;

    public function __construct() {
        $this->model = new UsuarioModel();
    }


    public function index(){
        $producto = $this->model->findAll();
        return view('ver_usuario', ['usuario'=> $producto]);
    }
}