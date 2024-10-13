<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;


class UsuariosController extends ResourceController
{

    protected $modelName = "App\Models\UsuarioModel";
    protected $format = "json";


    public function index()
    {
        $usuario = $this->model->findAll();

        return $this->respond($usuario);
    }

    // FUNCION DE CREAR JEJEJEJE VERSION 1
    public function create()
    {
        $data = $this->request->getJSON(true);
        $data['estado'] = 'activo';

        // Verifica si ya existe un usuario con el mismo correoElectronico
        $existingUser = $this->model->where('correoElectronico', $data['correoElectronico'])->first();

        if ($existingUser) {
            return $this->fail("El correoElectronico ya está registrado.", 400);
        }

        // Inserta el nuevo usuario
        if ($this->model->insert($data)) {
            return $this->respondCreated($data, "Usuario creado con éxito.");
        }

        return $this->failValidationErrors($this->model->errors());
    }

    /* CREAR USUARIO Y EL CARRITO SE LE CREA AUTOMATICAMENTE :) */
   /*  public function create()
{
    $data = $this->request->getJSON(true);
    $data['estado'] = 'activo'; */

    // Verifica si ya existe un usuario con el mismo correoElectronico
   /*  $existingUser = $this->model->where('correoElectronico', $data['correoElectronico'])->first();

    if ($existingUser) {
        return $this->fail("El correoElectronico ya está registrado.", 400);
    } */

    // Inserta el nuevo usuario
  //  if ($this->model->insert($data)) {
        // Obtiene el ID del nuevo usuario
        // $userId = $this->model->insertID();

        // Crea el carrito asociado al nuevo usuario
      /*  $carritoData = [
            'usuarioId' => $userId,
            'estado' => 'pendiente',
            'fechaCreacion' => date('Y-m-d'), // Establece la fecha actual
            'fechaActualizacion' => date('Y-m-d'), // Establece la fecha actual
        ]; */
 
        // Inserta el carrito
       /*  $carritoModel = new \App\Models\CarritoModel(); // Asegúrate de cargar el modelo del carrito
        if (!$carritoModel->insert($carritoData)) {
            return $this->failValidationErrors($carritoModel->errors());
        }

        return $this->respondCreated($data, "Usuario creado con éxito y carrito asociado.");
    }

    return $this->failValidationErrors($this->model->errors());
} */

    public function show($id = null)
    {
        $usuario = $this->model->find($id);

        if ($usuario) {
            return $this->respond($usuario);

        }

        return $this->failNotFound("Usuario no encontrado");
    }

    public function update($id = null)
    {

        // ver por id
        $usuario = $this->model->find($id);


        // personalizar
        if (!$usuario) {
            return $this->failNotFound("Usuario no encontrado");

        }


        // agregar
        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, "Usuario actualizado");

        }
        ;

        return $this->fail('No se pudo actualizar el usuario');
    }


    public function delete($id = null)
    {
        $usuario = $this->model->find($id);

        if ($usuario) {
            $this->model->delete($id);
            return $this->respondDeleted($usuario, "Usuario eliminado");

        }

        return $this->failNotFound("Tipo producto no encontrado");
    }

}