drop database if exists api;
create database if not exists api;

use api;

CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) not null,
  description TEXT,
  price DECIMAL(10, 2) not null,
  stock INT not null
);


/*TABLA 1*/
CREATE TABLE tipoProducto(
idTipoProducto int primary key auto_increment,
nombre varchar(100) not null,
descripcion varchar(100)not null,
estado varchar(50) not null
);

/*TABLA 2*/
CREATE TABLE productos(
idProducto int primary key auto_increment,
nombre varchar(100) not null,
descripcion varchar(100) not null,
precio decimal(10,2) not null,
stock int not null,
imagen varchar(100),
estado varchar(50) not null,
tipoProductoId int not null
);

/* select * from api.usuarios; */

select * from api.productos;
/* TABLA 3 */
CREATE TABLE usuario(
idUsuario int primary key auto_increment,
nombre varchar(100) not null,
apellido varchar(100) not null,
correoElectronico varchar(50) not null,
password varchar(50) not null,
estado varchar(50) not null
);

/* TABLA 4 */
CREATE TABLE carrito(
idCarrito int primary key auto_increment,
usuarioId int not null,
fechaCreacion date not null,
fechaActualizacion date,
estado varchar(50) not null
);

/* tabla 5*/
CREATE TABLE detalleCarrito(
idDetalle int primary key auto_increment,
carritoId int not null,
productoId int not null,
cantidadCompra int not null,
precio decimal(10,2) not null,
subTotal decimal(10,2) not null,
estado varchar(50) not null
);

/* ALTERAR TABLA DETALLE CARRITO */
alter table detalleCarrito
add constraint fk_carritoId
foreign key (carritoId) references carrito(idCarrito)
on delete cascade
on update cascade;

alter table detalleCarrito
add constraint fk_productoId
foreign key (productoId) references productos(idProducto)
on delete cascade 
on update cascade;

/*ALTERAR TABLA PRODUCTOS*/
ALTER TABLE productos
ADD CONSTRAINT fk_tipoProducto
FOREIGN KEY (tipoProductoId) REFERENCES tipoProducto(idTipoProducto)
ON DELETE CASCADE
ON UPDATE CASCADE;

/* ALTERAR TABLA CARRITO */
alter table carrito
add constraint fk_idUsuario
foreign key (usuarioId) references usuario(idUsuario)
on delete cascade
on update cascade;

