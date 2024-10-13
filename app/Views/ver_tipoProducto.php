<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Tipo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    h2 {
        text-align: center;
    }

    a {
        text-decoration: none;
    }
</style>

<body>

    <?php include('header.php'); ?>
    <br>

    <section class="shop contenedor">

        <a href="/fs2024/wordskills/public/agregar-tipoProducto">
            <button type="button" class="btn btn-outline-primary">
                Agregar tipo
            </button>
        </a>

        <br>
        <br>
        <br>
        <br>
        <!-- FORMULARIO PARA AGREGAR -->
        <h2 class="section-title">TODOS LOS TIPOS DE PRODUCTOS</h2>



        <div id="tipoProducto-list" class="shop-content"></div>
        <br>
        <br>
        <br>
        <br>
        <h2 class="section-title">Agregar Tipo Producto</h2>


        <form id="product-form">

            <input type="text" id="nombre" placeholder="Ingrese el nombre del tipo producto" autocomplete="off"
                required>

            <input type="text" id="descripcion" placeholder="Ingrese la descripción del tipo producto"
                autocomplete="off" required>
            <input type="text" id="estado" placeholder="Ingrese el estado del tipo producto" autocomplete="off"
                required>

            <button type="submit">Agregar Tipo Producto</button>


        </form>


        <br>
        <br>
        <br>
        <br>

        <!-- FORMULARIO PARA EDITAR -->

        <h2 class="section-title">Editar Tipo Producto</h2>
        <form id="edit-product-form" style="display: none;">
            <input type="hidden" id="edit-id">
            <input type="text" id="edit-nombre" placeholder="Ingrese el nombre del producto" autocomplete="off"
                required>
            <input type="text" id="edit-descripcion" placeholder="Ingrese la descripción del producto"
                autocomplete="off" required>
            <input type="text" id="edit-estado" placeholder="Ingrese el estado del producto" autocomplete="off"
                required>
            <button type="submit">Actualizar Tipo Producto</button>
        </form>

    </section>

    <script src="js/funcionesTiposProductos.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>