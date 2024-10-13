<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <title>Productos</title>
</head>
<style>
    h2 {
        text-align: center;
    }
    
</style>
<body>
    <br><br><br><br>
    <?php include('header.php'); ?>

    <section class="shop contenedor">

    <h2 class="section-title">TODOS LOS PRODUCTOS</h2>
    <div id="producto-list" class="shop-content"></div>
    <br>
    <br>
    <br>
    <br>
    <h2 class="section-title">Agregar Producto</h2>

    <form id="product-form">

    <input type="text" id="nombre" placeholder="Ingrese el nombre del producto" autocomplete="off" required>
    <input type="text" id="descripcion" placeholder="Ingrese la descripcion del producto" autocomplete="off" required>
    <input type="text" id="precio" placeholder="Ingrese el precio del producto" autocomplete="off" required>
    <input type="number" id="stock" placeholder="Ingrese el stock del producto" autocomplete="off" required>
    <input type="number" id="tipoProductoId" placeholder="Ingrese el Id tipo Producto " autocomplete="off" required>

    <button type="submit">Agregar Producto</button>

    </form>

    </section>

    <script src="js/funcionesProductos.js"></script>
    <script src="js/main.js"></script>

</body>
</html>