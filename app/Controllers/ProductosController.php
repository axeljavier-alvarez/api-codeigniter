<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductosController extends ResourceController
{
    /* importar el modelo */
    protected $modelName = "App\Models\ProductoModel";
    protected $format = "json";


    /* PRIMER METODO */
    public function index()
    {

        $producto = $this->model->findAll();
        return $this->respond($producto);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        // Establecer el estado como "activo"
        $data['estado'] = 'activo';

        if ($this->model->insert($data)) {
            return $this->respondCreated($data, 'Producto creado');
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function show($id = null)
    {
        $producto = $this->model->find($id);
        if ($producto) {
            return $this->respond($producto);
        }

        return $this->failNotFound('Producto no encontrado');
    }

    public function update($id = null)
    {
        $producto = $this->model->find($id);

        if (!$producto) {
            return $this->failNotFound("Producto no encontrado");

        }


        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Producto actualizado');
        }


        return $this->fail("No se pudo actualizar el producto");
    }


    public function delete($id = null)
    {
        $producto = $this->model->find($id);
        if ($producto) {

            $this->model->delete($id);
            return $this->respondDeleted($producto, "Producto eliminado");
        }

        return $this->failNotFound("Producto no encontrado");
    }

    /* ver producto por id */
    public function getByTipo($tipoProductoId = null)
    {
        if ($tipoProductoId === null) {
            return $this->fail("El tipo de producto no puede ser nulo.", 400);
        }

        $productos = $this->model->where('tipoProductoId', $tipoProductoId)->findAll();

        if (count($productos) > 0) {
            return $this->respond($productos);
        }

        return $this->failNotFound('No se encontraron productos para este tipo de producto.');
    }




}