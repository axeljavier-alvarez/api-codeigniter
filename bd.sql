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
precio int not null,
stock int not null,
imagen varchar(100),
estado varchar(50) not null,
idTipoProducto int
);

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
idUsuario int,
fechaCreacion date,
fechaActualizacion date,
estado varchar(50)
);

/**/
/*ALTERAR TABLA PRODUCTOS*/
ALTER TABLE productos
ADD CONSTRAINT fk_tipoProducto
FOREIGN KEY (idTipoProducto) REFERENCES tipoProducto(idTipoProducto)
ON DELETE CASCADE
ON UPDATE CASCADE;

/* ALTERAR TABLA CARRITO */
alter table carrito
add constraint fk_idUsuario
foreign key (idUsuario) references usuario(idUsuario)
on delete cascade
on update cascade;


