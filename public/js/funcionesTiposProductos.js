// Función para cargar los datos de los tipos de productos
async function fetchTipoProducto() {
    try {
        const response = await fetch('http://localhost/fs2024/wordskills/public/tipoProducto');
        if (!response.ok) {
            throw new Error('La respuesta no es correcta: ' + response.statusText);
        }
        const tipoProducto = await response.json();
        displayTipoProducto(tipoProducto);
    } catch (error) {
        console.log("Error al obtener datos: ", error);
        alert("Error al ver datos: " + error.message);
    }
}

// Función para mostrar los tipos de productos
function displayTipoProducto(tipoProducto) {
    const tipoProductoList = document.getElementById('tipoProducto-list');
    tipoProductoList.innerHTML = ''; // Limpiar la lista existente

    tipoProducto.forEach(datoTipoProducto => {
        const tipoProductoBox = document.createElement('div');
        tipoProductoBox.className = 'product-box';

        tipoProductoBox.innerHTML = `
            <h3>${datoTipoProducto.nombre}</h3>
            <p><strong>ID:</strong> ${datoTipoProducto.idTipoProducto}</p>
            <p><strong>Descripción:</strong> ${datoTipoProducto.descripcion}</p>
            <p><strong>Estado:</strong> ${datoTipoProducto.estado}</p>
            <button class="btn btn-danger delete-btn" data-id="${datoTipoProducto.idTipoProducto}">Eliminar</button>
            <button class="btn btn-warning edit-btn" data-id="${datoTipoProducto.idTipoProducto}">Editar</button>
            <i class='bx bx-shopping-bag add-cart'></i>
        `;

        tipoProductoList.appendChild(tipoProductoBox);
    });

    // Añadir eventos a los botones de eliminar
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const tipoProductoId = event.target.getAttribute('data-id');
            deleteTipoProducto(tipoProductoId);
        });
    });

    // Añadir eventos a los botones de editar
    const editButtons = document.querySelectorAll('.edit-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const tipoProductoId = event.target.getAttribute('data-id');
            loadTipoProductoForEdit(tipoProductoId);
        });
    });
}

// Función para eliminar un tipo de producto
async function deleteTipoProducto(id) {
    const confirmation = confirm('¿Está seguro que desea eliminar este Tipo Producto?');
    if (!confirmation) return;

    try {
        const response = await fetch(`http://localhost/fs2024/wordskills/public/tipoProducto/${id}`, {
            method: 'DELETE'
        });

        if (!response.ok) {
            throw new Error('Error al eliminar el producto: ' + response.statusText);
        }

        fetchTipoProducto(); // Actualizar la lista
    } catch (error) {
        console.log('Error: ', error);
        alert('Error al eliminar el tipo producto: ' + error.message);
    }
}

// Función para agregar un nuevo tipo de producto
/* document.getElementById('product-form').addEventListener('submit', async (event) => {
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
        fetchTipoProducto(); // Actualizar la lista
    } catch (error) {
        console.error('Error: ', error);
        alert('Error al agregar el producto: ' + error.message);
    }
}); */

// Función para cargar los datos del tipo de producto para editar
async function loadTipoProductoForEdit(id) {
    try {
        const response = await fetch(`http://localhost/fs2024/wordskills/public/tipoProducto/${id}`);
        if (!response.ok) {
            throw new Error('Error al obtener el producto: ' + response.statusText);
        }
        const producto = await response.json();

        // Llenar el formulario de edición con los datos
        document.getElementById('edit-id').value = producto.idTipoProducto;
        document.getElementById('edit-nombre').value = producto.nombre;
        document.getElementById('edit-descripcion').value = producto.descripcion;
        document.getElementById('edit-estado').value = producto.estado;

        // Mostrar el formulario de edición
        document.getElementById('edit-product-form').style.display = 'block';
    } catch (error) {
        console.error('Error: ', error);
        alert('Error al cargar el tipo producto: ' + error.message);
    }
}

// Manejar el envío del formulario de edición
document.getElementById('edit-product-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const updatedTipoProducto = {
        nombre: document.getElementById('edit-nombre').value,
        descripcion: document.getElementById('edit-descripcion').value,
        estado: document.getElementById('edit-estado').value
    };
    const id = document.getElementById('edit-id').value;

    try {
        const response = await fetch(`http://localhost/fs2024/wordskills/public/tipoProducto/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(updatedTipoProducto),
        });

        if (!response.ok) {
            throw new Error('Error al actualizar el tipo producto: ' + response.statusText);
        }

        // Limpiar el formulario de edición y ocultarlo
        document.getElementById('edit-product-form').reset();
        document.getElementById('edit-product-form').style.display = 'none';

        fetchTipoProducto(); // Actualizar la lista de productos
    } catch (error) {
        console.error('Error: ', error);
        alert('Error al actualizar el producto: ' + error.message);
    }
});

// Cargar los datos al iniciar la página
window.onload = fetchTipoProducto;