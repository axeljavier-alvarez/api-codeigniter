<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

/* RUTA ESPECIFICA PARA CREAR TODAS LAS RUTAS Y OCULTAR DOS controller y products para cambiar el nombre */
// $routes->resource('products', ['except' => 'new,edit'/* , 'controller'=> 'Products'*/]);


/* RUTAS VIEW OVERALL*/
// $routes->get('/view-products', 'ViewProducts::index');
$routes->get('/view-tipoProductos', 'ViewTipoProductos::index');
$routes->get('/view-productos', 'ViewProductos::index');
$routes->get('/view-usuarios', 'ViewUsuarios::index');
$routes->get('/view_carrito', 'ViewCarritos::index');

/* PARA AGREGAR */
$routes->get('/agregar-tipoProducto', 'AgregarTipoProducto::index');

/* ---------------------------------- */
/* PARA PRODUCTOS */
/*$routes->get('/products', 'ProductosController::index');
$routes->get('/products/(:num)', 'ProductosController::show/$1');
$routes->post('/products', 'ProductosController::create');
$routes->put('/products/(:num)', 'ProductosController::update/$1'); 
$routes->delete('/products/(:num)', 'ProductosController::delete/$1'); */


/* PARA PRODUCTOS */
$routes->get('/producto', 'ProductosController::index');
$routes->post( '/producto', 'ProductosController::create');
$routes->get('/producto/(:num)', 'ProductosController::show/$1');
$routes->put('/producto/(:num)', 'ProductosController::update/$1'); 
$routes->delete('/producto/(:num)', 'ProductosController::delete/$1');
$routes->get('/productos/tipoProducto/(:num)', 'ProductosController::getByTipo/$1');


/* PARA TIPO PRODUCTOS */
$routes->get('/tipoProducto', 'TipoProductoController::index');
$routes->get('/tipoProducto/(:num)', 'TipoProductoController::show/$1');
$routes->post('/tipoProducto', 'TipoProductoController::create');
$routes->put('/tipoProducto/(:num)', 'TipoProductoController::update/$1'); 
$routes->delete('/tipoProducto/(:num)', 'TipoProductoController::delete/$1');
$routes->get('/tipoProducto/(:num)/productos', 'TipoProductoController::getProductosPorTipo/$1');

/* PARA USUARIOS */
$routes->get('/usuario', 'UsuariosController::index');
$routes->post('/usuario', "UsuariosController::create");
$routes->get('/usuario/(:num)', 'UsuariosController::show/$1');
$routes->put('/usuario/(:num)', "UsuariosController::update/$1");
$routes->delete('/usuario/(:num)', 'UsuariosController::delete/$1');

/* PARA CARRITOS */
$routes->get('/carrito', 'CarritosController::index');
$routes->post('/carrito', 'CarritosController::create');
$routes->delete('/carrito/(:num)', 'CarritosController::delete/$1');
$routes->put('/carrito/(:num)', 'CarritosController::update/$1');


/* PARA EL DETALLE CARRITO */
$routes->get('/detallecarrito', 'DetalleCarritoController::index');
/* AGREGAR CARRITO 
* Agrega un producto a cada detalle carrito
* Si el mismo producto que ya existe se quiere agregar mas se va sumando y no se crea otro idDetalle
* El stock se disminuye del producto ya que es cantidadComprada
* para el subtotal se multiplica cantidadCompra * precio
* Verificaciones por hacer que no acepte numeros negativos
*/
$routes->post('/detalleCarrito', 'DetalleCarritoController::create');
/* ELIMINAR CARRITO
* El stock regresa a su lugar 
*/
$routes->delete('/detalleCarrito/(:num)', 'DetalleCarritoController::delete/$1');
/* 
EDITAR 
puede editar la cantidadComprada, aumentarla o disminuirla, siempre y cuando sea menor al stock
la tengo que arreglar ya que si ingresa un numero tiene que sumarlo con el que ya esta y lo mismo
si se disminuye, y restarlo o sumarlo con el stock
*/
$routes->put('/detalleCarrito/(:num)', 'DetalleCarritoController::update/$1'); 
