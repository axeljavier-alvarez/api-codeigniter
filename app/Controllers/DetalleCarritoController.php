<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;


class DetalleCarritoController extends ResourceController
{
    protected $modelName = "App\Models\DetalleCarritoModel";
    protected $format = 'json';

    public function index()
    {
        $detallecarrito = $this->model->findAll();
        return $this->respond($detallecarrito);
    }

    // aca es donde se hara el detalle carrito

    public function create()
    {
        $carritoId = $this->request->getVar('carritoId');
        $productoId = $this->request->getVar('productoId');
        $cantidadCompra = $this->request->getVar('cantidadCompra');

       

        // Verificar stock
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($productoId);

        if (!$producto) {
            return $this->fail("Producto no encontrado.");
        }

        // Verificar stock total considerando el detalle actual
        $detalleExistente = $this->model->where(['carritoId' => $carritoId, 'productoId' => $productoId])->first();
        $cantidadActual = $detalleExistente ? $detalleExistente['cantidadCompra'] : 0;
        $cantidadTotal = $cantidadActual + $cantidadCompra;

        if ($cantidadTotal > $producto['stock']) {
            return $this->fail("Stock insuficiente.");
        }

        if ($detalleExistente) {
            // Actualizar cantidad
            $nuevaCantidad = $cantidadTotal;
            $subTotal = $nuevaCantidad * $producto['precio']; // Recalcular subTotal

            $this->model->update($detalleExistente['idDetalle'], [
                'cantidadCompra' => $nuevaCantidad,
                'subTotal' => $subTotal // Actualizar subTotal
            ]);
        } else {
            // Crear nuevo detalle
            $subTotal = $cantidadCompra * $producto['precio']; // Calcular subTotal para nuevo detalle
            $data = [
                'carritoId' => $carritoId,
                'productoId' => $productoId,
                'cantidadCompra' => $cantidadCompra,
                'precio' => $producto['precio'],
                'subTotal' => $subTotal,
                'estado' => 'activo'
            ];

            $this->model->insert($data);
        }

        // Actualizar stock del producto
        $productoModel->update($productoId, ['stock' => $producto['stock'] - $cantidadCompra]);

        return $this->respond($detalleExistente ? $this->model->find($detalleExistente['idDetalle']) : $data);
    }




    /* FUNCION PARA ELIMINAR */
    public function delete($id = null)
    {
        // Encontrar el detalle del carrito
        $detallecarrito = $this->model->find($id);

        if (!$detallecarrito) {
            return $this->failNotFound('Detalle carrito no encontrado.');
        }

        // Obtener el producto correspondiente
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($detallecarrito['productoId']);

        if (!$producto) {
            return $this->failNotFound('Producto no encontrado.');
        }

        // Reasignar la cantidadComprada al stock del producto
        $nuevaCantidadStock = $producto['stock'] + $detallecarrito['cantidadCompra'];
        $productoModel->update($detallecarrito['productoId'], ['stock' => $nuevaCantidadStock]);

        // Eliminar el detalle del carrito
        $this->model->delete($id);

        return $this->respondDeleted($detallecarrito, 'Detalle carrito eliminado y stock actualizado.');
    }

    /* FUNCION PARA EDITAR */
    public function update($id = null)
    {
        // Obtener los datos de la solicitud
        $cantidadCompra = $this->request->getVar('cantidadCompra');

        // Validar que cantidadCompra sea un número
        if (!is_numeric($cantidadCompra) || $cantidadCompra < 0) {
            return $this->fail("La cantidad de compra debe ser un número mayor o igual a cero.");
        }

        // Encontrar el detalle del carrito
        $detallecarrito = $this->model->find($id);

        if (!$detallecarrito) {
            return $this->failNotFound('Detalle carrito no encontrado.');
        }

        // Obtener el producto correspondiente
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($detallecarrito['productoId']);

        if (!$producto) {
            return $this->failNotFound('Producto no encontrado.');
        }

        // Calcular la nueva cantidad total
        $nuevaCantidad = $cantidadCompra;

        // Verificar que la nueva cantidad no exceda el stock
        if ($nuevaCantidad > $producto['stock']) {
            return $this->fail("Stock insuficiente.");
        }

        // Calcular el nuevo subtotal
        $subTotal = $nuevaCantidad * $producto['precio'];

        // Actualizar el detalle del carrito
        $this->model->update($id, [
            'cantidadCompra' => $nuevaCantidad,
            'subTotal' => $subTotal // Actualizar subTotal
        ]);

        // Responder con el detalle actualizado y código de estado 200
        return $this->respond($this->model->find($id), 200, 'Detalle carrito actualizado.');
    }

}
