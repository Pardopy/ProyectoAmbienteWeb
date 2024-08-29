<?php
    // Imports
    require_once('../../Controller/soporteController.php');

    if (isset($_GET['action'])) {
      
      switch ($_GET['action']) {
        case 'submitTicket':
            soporteController::addSupportTicket($_POST);
            print_r($_POST);  

            break;
      }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroConnect - Soporte</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- CSS -->
  <link rel="stylesheet" href="styleKevin.css">

  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

  <!-- Header original -->
  <!-- <header>
    <div class="contenedor">
      <a href="index.html" class="logotipo">AgroConnect</a>
      
      <nav>
        <ul>
          <li><a href="index.html">Inicio</a></li>
          <li><a href="acerca.html">Acerca de</a></li>
          <li><a href="productos.html">Productos</a></li>
          <li><a href="comofunciona.html">Cómo funciona</a></li>
          <li><a href="registrarse.html" class="boton boton-primario">Registrarse</a></li>
          <li><a href="login.html" class="boton boton-secundario">Iniciar sesión</a></li>
        </ul>
      </nav>
    </div>
  </header> -->

  <!-- Header modificado -->
  <header>
    <div class="contenedor">
      <a href="../html-otros/Index.html" class="logotipo">AgroConnect</a>
      
      <nav>
        <ul>
          <li><a href="../html-otros/Index.html">Inicio</a></li>
          <li><a href="../html-kevin/productos.html">Productos</a></li>
          <li><a href="../html-otros/GestionPedidos.html">Pedidos</a></li>
          <li><a href="../html-heymmy/Foro.html">Foro</a></li>
          <li><a href="../html-kevin/soporte.html">Soporte</a></li>
          <li><a href="../html-heymmy/Registro.html" class="boton boton-primario">Registrarse</a></li>
          <li><a href="../html-otros/login.html" class="boton boton-secundario">Iniciar sesión</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Breadcrumb Block -->
  <section style="margin-bottom: 0;">
    <div class="py-5 color5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="fw-bold">Soporte y Ayuda</h1>
          <svg width="64px" height="64px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>support</title> <rect width="24" height="24" fill="none"></rect> <path d="M12,2a8,8,0,0,0-8,8v1.9A2.92,2.92,0,0,0,3,14a2.88,2.88,0,0,0,1.94,2.61C6.24,19.72,8.85,22,12,22h3V20H12c-2.26,0-4.31-1.7-5.34-4.39l-.21-.55L5.86,15A1,1,0,0,1,5,14a1,1,0,0,1,.5-.86l.5-.29V11a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1v5H13.91a1.5,1.5,0,1,0-1.52,2H20a2,2,0,0,0,2-2V14a2,2,0,0,0-2-2V10A8,8,0,0,0,12,2Z"></path> </g></svg>
        </div>
      </div>
    </div>
  </section>

  <main class="main-bg-soporte">
    <div class="div-bg-soporte">

      <div class="container py-5">
        <div class="row g-5">
          <!-- Información de Contacto -->
          <div class="col-xl-6">
            <div class="row row-cols-md-2 g-4"> 
  
              <!-- Correo -->
              <div>
                <div class="color2 text-light d-block p-3">
                  <div class="d-flex justify-content-start">
                    <i class="fa-solid fa-envelope h3 pe-2"></i>
                    <span class="h5">Correo</span>
                  </div>
                  <span>soporte@agroconnect.com</span>
                </div>
              </div>
              
              <!-- Teléfono -->
              <div>
                <div class="color2 text-light d-block p-3">
                  <div class="d-flex justify-content-start">
                    <i class="fa-solid fa-phone h3 pe-2"></i>
                    <span class="h5">Teléfono</span>
                  </div>
                  <span>+506 2020 2020, +506 4040 4040</span>
                </div>
              </div>
            </div>
  
            <!-- Ubicación -->
            <div class="mt-4">
                <div class="color2 text-light d-block p-3">
                  <div class="d-flex justify-content-start">
                    <i class="fa-solid fa-location-pin h3 pe-2"></i>
                    <span class="h5">Ubicación</span>
                  </div>
                  <span>Calle Central y Primera, Avenida 14, San José, San José</span>
                </div>
            </div>
  
            <!-- Mapa -->
            <div>
              <div class="mt-4 w-100">
                <iframe class="hvr-shadow" width="100%" height="345" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/distance-area-calculator.html">measure acres/hectares on map</a></iframe>
              </div>
            </div>
          </div>
  
          <!-- Formulario -->
          <div class="col-xl-6">
            <h2 class="pb-4 text-light">¡Envíanos un mensaje!</h2>
            <form action="../html-kevin/soporte.php?action=submitTicket" method="POST" id="soporte-form">
              <div class="row g-4">
                <div class="col-6 mb-3">
                  <label for="nombre" class="form-label text-light">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="John" required>
                </div>
                <div class="col-6 mb-3">
                  <label for="apellido" class="form-label text-light">Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Doe" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="correo" class="form-label text-light">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="john@doe.com" required>
              </div>
              <div class="mb-3">
                <label for="telefono" class="form-label text-light">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+506 8888 0000" required>
              </div>
              <div class="mb-3">
                <label for="tema" class="form-label text-light">Tema</label>
                <select class="form-select" id="tema" name="tema">
                  <option value="Cotización">Cotización</option>
                  <option value="Soporte">Soporte</option>
                  <option value="Sugerencia">Sugerencia</option>
                  <option value="Reportes">Reportes</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="mensaje" class="form-label text-light" required>Mensaje</label>
                <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Escribe tu mensaje aquí..."></textarea>
              </div>
              <button type="submit" class="btn text-light fw-bold" style="background-color: #648A64;">Enviar mensaje</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </main>
  

  <!-- Footer original -->
  <!-- <footer>
    <div class="contenedor">
      <div class="columna-pie-de-index">
        <p>&copy; 2024 AgroConnect</p>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <li><a href="#">Acerca de</a></li>
            <li><a href="#">Productos</a></li>
            <li><a href="#">Cómo funciona</a></li>
            <li><a href="TerminosCondiciones.html">Términos y condiciones</a></li>
          </ul>
        </nav>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <li><a href="login.html">Registrarse</a></li>
            <li><a href="login.html">Iniciar sesión</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </footer> -->

  <!-- Footer modificado -->
  <footer>
    <div class="contenedor">
      <div class="columna-pie-de-index">
        <p>&copy; 2024 AgroConnect</p>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <li><a href="../html-otros/HerraBenAgri.html">Herramientas</a></li>
            <li><a href="../html-heymmy/Certificaciones.html">Certificaciones</a></li>
            <li><a href="../html-otros/TerminosCondiciones.html">Términos y condiciones</a></li>
          </ul>
        </nav>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <li><a class="boton boton-primario" href="../html-heymmy/Registro.html">Registrarse</a></li>
            <li><a class="boton boton-secundario" href="../html-otros/login.html">Iniciar sesión</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </footer>



  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="js.js"></script>
</body>
</html>