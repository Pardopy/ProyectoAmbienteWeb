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
  navLinks.forEach(link => link.addEventListener('click', toggleActiveLink));
  