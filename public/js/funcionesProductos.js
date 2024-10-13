async function fetchProducto() {

    try {

        // acceder a la ruta
        const response = await fetch('http://localhost/fs2024/wordskills/public/producto');

        // verificacion
        if (!response.ok) {
            throw new Error('Error en la respuesta' + response.statusText);

        }

        const producto = await response.json();
        displayProducto(producto);

    } catch (error) {
        console.error('Error:', error);
        alert("Error al ver los datos: " + error.message);
    }
}


function displayProducto(producto) {
    const productoList = document.getElementById('producto-list');
    productoList.innerHTML = '';
    producto.forEach(datoProducto => {

        const productoBox = document.createElement('div');
        productoBox.className = 'product-box';

        productoBox.innerHTML = ` 
        <h3>${datoProducto.nombre}</h3>

        <p><strong>ID: </strong> ${datoProducto.idProducto}</p>
        <p><strong>Nombre: </strong> ${datoProducto.nombre}</p>
        <p><strong>Descripción: </strong> ${datoProducto.descripcion}</p>
        <p><strong>Precio: </strong> ${datoProducto.precio}</p>
        <p><strong>Stock: </strong> ${datoProducto.stock}</p>
        <p><strong>Estado: </strong> ${datoProducto.estado}</p>
        <p><strong>Tipo Producto Id: </strong> ${datoProducto.tipoProductoId}</p>

        <button class="delete-btn" data-id="${datoProducto.idProducto}">Eliminar</button>
        <i class='bx bx-shopping-bag add-cart'></i>
        `
        productoList.appendChild(productoBox);
    })


    /* Añadir eventos a los botones */
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const productoId = event.target.getAttribute('data-id');
            deleteProducto(productoId);
        })
    })
}

async function deleteProducto(id) {

    const confirmation = confirm('¿Esta seguro que quiere eliminar este producto?');
    if (!confirmation) return;

    try {

        const response = await fetch(`http://localhost/fs2024/wordskills/public/producto/${id}`, {
            method: 'DELETE'
        });

        if (!response.ok) {
            throw new Error('Error al eliminar el producto: ' + response.statusText);
        }

        fetchProducto();

    } catch (error) {
        console.log('Error: ', error);
        alert('Error al eliminar el tipo producto: ' + error.message);
    }
}

// PARTE PARA AGREGAR UN NUEVO PRODUCTO
document.getElementById('product-form').addEventListener('submit', async (event)=>{
    event.preventDefault();

    const newProducto = {
       nombre: document.getElementById('nombre').value,
       descripcion: document.getElementById('descripcion').value,
       precio: document.getElementById('precio').value,
       stock: document.getElementById('stock').value,
       tipoProductoId: document.getElementById('tipoProductoId').value
    };

    try {

        const response = await fetch('http://localhost/fs2024/wordskills/public/producto', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(newProducto),
        });

        if(!response.ok){
            throw new Error('Error al agregar el producto: ' + response.statusText);
        }

        document.getElementById('product-form').reset(); // Limpiar el formulario

        fetchProducto();
    } catch(error){
        console.error('Error: ', error);
        alert('Error al agregar el producto: ' + error.message);
        
    }
})


// Cargar los datos al iniciar la página
window.onload = fetchProducto;