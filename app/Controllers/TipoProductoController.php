<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class TipoProductoController extends ResourceController
{

    /* OVERALL */
    protected $modelName = "App\Models\TipoProductoModel";
    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    /* FUNCION INDEX QUE ES DONDE QUIERO QUE SE MUESTREN LOS DATOS */
    public function index()
    {
        $tipoProducto = $this->model->findAll();
        return $this->respond($tipoProducto);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $tipoProducto = $this->model->find($id);
        if ($tipoProducto) {
            return $this->respond($tipoProducto);
        }

        return $this->failNotFound('Tipo de producto no encontrado');
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */


    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */

    /* creacion */
    public function create()
    {


        $data = $this->request->getJSON(true);
        // print_r($data);
        if ($this->model->insert($data)) {
            return $this->respondCreated($data, 'Tipo Producto creado');
        }
        ;

        return $this->failValidationErrors($this->model->errors());
    }



    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $tipoProducto = $this->model->find($id);

        /* MISMA RESPUESTA DE SHOW */
        if (!$tipoProducto) {
            return $this->failNotFound('Tipo Producto  no encontrado');
        }

        /* JSON DE CREATE */
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Tipo Producto actualizado');
        }

        /* con este si me muestra el error que estoy cometiendo */
        return $this->fail('No se pudo actualizar el tipo producto');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $tipoProducto = $this->model->find($id);
        if ($tipoProducto) {
            $this->model->delete($id);
            return $this->respondDeleted($tipoProducto, 'Tipo producto eliminado');
        }

        return $this->failNotFound('Tipo producto no encontrado');

    }

    /* ver producto por tipo */
    public function getProductosPorTipo($tipoProductoId = null)
    {
        if ($tipoProductoId === null) {
            return $this->fail("El tipo de producto no puede ser nulo.", 400);
        }

        // Asegúrate de cargar el modelo de productos
        $productoModel = new \App\Models\ProductoModel();
        $productos = $productoModel->where('tipoProductoId', $tipoProductoId)->findAll();

        if (count($productos) > 0) {
            return $this->respond($productos);
        }

        return $this->failNotFound('No se encontraron productos para este tipo de producto.');
    }

}
