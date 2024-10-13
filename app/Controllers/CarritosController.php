<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;


class CarritosController extends ResourceController
{
    protected $modelName = 'App\Models\CarritoModel';

    protected $format = "json";


    public function index()
    {
        $carrito = $this->model->findAll();
        return $this->respond($carrito);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        // Establece el estado y la fecha de creación
        $data['estado'] = 'pendiente';
        $data['fechaCreacion'] = date('Y-m-d'); // Establece la fecha actual

        // Verifica si ya existe un carrito para el usuarioId
        $existingCart = $this->model->where('usuarioId', $data['usuarioId'])->first();

        if ($existingCart) {
            return $this->fail("Ya existe un carrito para el usuario con ID {$data['usuarioId']}.", 400);
        }

        // Inserta el nuevo carrito
        if ($this->model->insert($data)) {
            return $this->respondCreated($data, 'Carrito creado');
        }

        return $this->failValidationErrors($this->model->errors());
    }


    public function update($id = null)
    {
        // ver por id
        $carrito = $this->model->find($id);


        // personalizar
        if (!$carrito) {
            return $this->failNotFound("Carrito no encontrado");

        }


        // agregar
        $data = $this->request->getJSON(true);

        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, "Usuario actualizado");

        }
        ;

        return $this->fail('No se pudo actualizar el carrito');

    }
    public function delete($id = null)
    {
        $carrito = $this->model->find($id);

        if ($carrito) {
            $this->model->delete($id);
            return $this->respondDeleted($carrito, 'Carrito eliminado');
        }


        return $this->failNotFound("Carrito no encontrado");
    }


}
