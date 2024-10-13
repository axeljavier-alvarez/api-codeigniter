async function fetchCarrito(){

    try{

        const response = await fetch('http://localhost/fs2024/wordskills/public/carrito');

        if(!response.ok){
            throw new Error('Error en la respuesta ' + response.statusText);
        }

        const carrito = await response.json();
        displayCarrito(carrito);

    } catch(error) {
        console.error('Error:', error);
        alert("Error al ver los datos: " + error.message);

    }
}

function displayCarrito(carrito){

    const carritoList = document.getElementById('carrito-list');
    carritoList.innerHTML = '';

    carrito.forEach(datoCarrito =>{
        const carritoBox = document.createElement('div');
        carritoBox.className = 'product-box';

        carritoBox.innerHTML = `
        <h3>${datoCarrito.idCarrito}</h3>
        <p><strong>Usuario Id: </strong>${datoCarrito.usuarioId}</p>
        
        <p><strong>Fecha creación:</strong>${datoCarrito.fechaActualizacion}</p>
        <p><strong>Estado:</strong>${datoCarrito.estado}</p>
        <p><strong>Fecha Actualización</strong>${datoCarrito.fechaCreacion}</p>
        `
        carritoList.appendChild(carritoBox);

    })
}
    

/* para ver */
document.getElementById('product-form').addEventListener('submit', async (event)=>{
 /* event.preventDefault();

    const newCarrito = {
        usuarioId: document.getElementById('usuarioId').value;
    };

    try{

        const response = await fetch('http://localhost/fs2024/wordskills/public/carrito', {

            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newCarrito),
        });

        if(!response.ok){

            throw new Error('Error al agregar el carrito: ' + response.statusText);

        }}

        document.getElementById('product-form').reset(); // Limpiar el formulario

        fetchCarrito();
        
    } catch(error){
        console.error('Error: ', error);
        alert('Error al agregar el producto: ' + error.message); */
        

   
    
});
window.onload = fetchCarrito;