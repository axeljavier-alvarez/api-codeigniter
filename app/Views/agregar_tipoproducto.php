<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Agregar Tipo Producto</title>
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

    .form-container {
        background-color: #ffffff;
        /* Fondo blanco */
        border-radius: 10px;
        /* Bordes redondeados */
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        /* Sombra suave */
    }
</style>

<body>

    <?php include('header.php'); ?>

    <br>
    <br>

    <div class="container my-4 d-flex justify-content-center">
    <div class="form-container p-4" style="max-width: 400px;">
        <h2 class="text-center mb-4">Agregar Tipo Producto</h2>
        <form id="product-form">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Tipo Producto</label>
                <input type="text" id="nombre" class="form-control" placeholder="Ingrese el nombre del tipo producto" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" id="descripcion" class="form-control" placeholder="Ingrese la descripción del tipo producto" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" id="estado" class="form-control" placeholder="Ingrese el estado del tipo producto" autocomplete="off" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Agregar Tipo Producto</button>
        </form>
    </div>
</div>
    <script>
        document.getElementById('product-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            const newTipoProducto = {
                nombre: document.getElementById('nombre').value,
                descripcion: document.getElementById('descripcion').value,
                estado: document.getElementById('estado').value
            };

            try {
                const response = await fetch('http://localhost/fs2024/wordskills/public/tipoProducto', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(newTipoProducto),
                });

                if (!response.ok) {
                    throw new Error('Error al agregar el tipo producto: ' + response.statusText);
                }

                document.getElementById('product-form').reset(); // Limpiar el formulario
                alert('Tipo de producto agregado exitosamente.');

                // Redirigir a la página de tipos de productos
                window.location.href = 'http://localhost/fs2024/wordskills/public/view-tipoProductos';

            } catch (error) {
                console.error('Error: ', error);
                alert('Error al agregar el producto: ' + error.message);
            }
        });

    </script>

    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>