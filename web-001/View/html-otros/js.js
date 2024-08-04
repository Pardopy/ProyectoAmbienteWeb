// Función para alternar la clase activa en los enlaces de navegación
function toggleActiveLink(event) {
    // Elimina la clase activa de todos los enlaces
    const links = document.querySelectorAll('nav ul li a');
    links.forEach(link => link.classList.remove('active'));
  
    // Agrega la clase activa al enlace cliqueado
    event.target.classList.add('active');
  }
  
  // Agrega escuchadores de eventos a los enlaces de navegación
  const navLinks = document.querySelectorAll('nav ul li a');
  navLinks.forEach(link => link.addEventListener('click', toggleActiveLink)); //Listo

  

  //Productos
  function addProduct() {
    alerta('Producto añadido al carrito');
}

  //Tracking
  const orderData = {
    "1": { status: "En camino", estimatedDelivery: "2024-08-08" },
    "12345": { status: "En camino", estimatedDelivery: "2024-08-08" },
    "67890": { status: "Entregado", estimatedDelivery: "2024-08-11" }
};

function trackOrder() {
    const orderId = document.getElementById('order-id').value;
    const orderStatusDiv = document.getElementById('order-status');

    if (orderData[orderId]) {
        const orderInfo = orderData[orderId];
        orderStatusDiv.innerHTML = `
            <p>Estado: ${orderInfo.status}</p>
            <p>Fecha de entrega estimada: ${orderInfo.estimatedDelivery}</p>
        `;
    } else {
        orderStatusDiv.innerHTML = "<p>Pedido no encontrado. Por favor, verifica el número de pedido.</p>";
    }
}



  //Configuracion de cuenta

  function updateAccount() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const newpassword = document.getElementById('newpassword').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    const messageDiv = document.getElementById('account-message');

    if (password !== confirmPassword) {
        messageDiv.innerHTML = '<p style="color: red;">Las contraseñas no coinciden.</p>';
        return;
    }
}


    //Busqueda Avanzada
    function performSearch() {
        const keyword = document.getElementById('keyword').value.toLowerCase();
        const category = document.getElementById('category').value;
        const priceMin = parseFloat(document.getElementById('price-min').value) || 0;
        const priceMax = parseFloat(document.getElementById('price-max').value) || Infinity;
        const rating = parseInt(document.getElementById('rating').value);
    
        const results = sampleData.filter(product => {
            return (product.title.toLowerCase().includes(keyword) || keyword === "") &&
                   (product.category === category || category === "all") &&
                   product.price >= priceMin &&
                   product.price <= priceMax &&
                   product.rating >= rating;
        });
    }    

