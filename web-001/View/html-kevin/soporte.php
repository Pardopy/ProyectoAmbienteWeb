<?php
    // Imports
    require_once('../../Controller/soporteController.php');
    require_once('../../Controller/loginController.php');

    // Iniciar la sesión
    session_start();

    if (isset($_GET['action'])) {
      
      switch ($_GET['action']) {
        case 'submitTicket':
            soporteController::addSupportTicket($_POST);
            print_r($_POST);  

            break;

        case 'logout':
            loginController::logout();
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
      <a href="../html-otros/index.php" class="logotipo">AgroConnect</a>
      
      <nav>
        <ul>
          <li><a href="../html-otros/index.php">Inicio</a></li>
          <li><a href="../html-kevin/productos.php">Productos</a></li>
          
          <?php
            // Si el usuario está logueado, mostrar el apartado de Pedidos
            if (isset($_SESSION['idUsuario'])) {
           ?>
                <li><a href="../html-heymmy/consultar.php">Pedidos</a></li>
            <?php
                }
            ?>
          <li><a href="../html-heymmy/foro.php">Foro</a></li>
          <li><a href="../html-kevin/soporte.php">Soporte</a></li>

          <?php
            // Si el carrito de compras existe, mostrar el icono
            if (isset($_SESSION['cart'])) {
          ?>
            <li style="padding-right: 0;"><a href="../html-kevin/carrito.php" class="boton" style="padding-right: 25%; margin-right: 2rem;">
            <svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </a></li>
          <?php
            }
           ?>

          <?php
            // Si el usuario está logueado, mostrar el botón de cerrar sesión
            if (isset($_SESSION['email'])) {
              if ($_SESSION['tipoUsuario'] == 'Agricultor') {
          ?>
                <li style="padding-right: 0;"><a href="../html-heymmy/perfilAgricultor.php" class="boton" style="padding-right: 25%;">
                <svg width="32px" height="32px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>profile [#1341]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -2159.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M134,2008.99998 C131.783496,2008.99998 129.980955,2007.20598 129.980955,2004.99998 C129.980955,2002.79398 131.783496,2000.99998 134,2000.99998 C136.216504,2000.99998 138.019045,2002.79398 138.019045,2004.99998 C138.019045,2007.20598 136.216504,2008.99998 134,2008.99998 M137.775893,2009.67298 C139.370449,2008.39598 140.299854,2006.33098 139.958235,2004.06998 C139.561354,2001.44698 137.368965,1999.34798 134.722423,1999.04198 C131.070116,1998.61898 127.971432,2001.44898 127.971432,2004.99998 C127.971432,2006.88998 128.851603,2008.57398 130.224107,2009.67298 C126.852128,2010.93398 124.390463,2013.89498 124.004634,2017.89098 C123.948368,2018.48198 124.411563,2018.99998 125.008391,2018.99998 C125.519814,2018.99998 125.955881,2018.61598 126.001095,2018.10898 C126.404004,2013.64598 129.837274,2010.99998 134,2010.99998 C138.162726,2010.99998 141.595996,2013.64598 141.998905,2018.10898 C142.044119,2018.61598 142.480186,2018.99998 142.991609,2018.99998 C143.588437,2018.99998 144.051632,2018.48198 143.995366,2017.89098 C143.609537,2013.89498 141.147872,2010.93398 137.775893,2009.67298" id="profile-[#1341]"> </path> </g> </g> </g> </g></svg>
                </a></li>
            <?php
              } else {
            ?>
                <li style="padding-right: 0;"><a href="../html-kevin/perfilComprador.php" class="boton" style="padding-right: 25%;">
                <svg width="32px" height="32px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>profile [#1341]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-180.000000, -2159.000000)" fill="#ffffff"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M134,2008.99998 C131.783496,2008.99998 129.980955,2007.20598 129.980955,2004.99998 C129.980955,2002.79398 131.783496,2000.99998 134,2000.99998 C136.216504,2000.99998 138.019045,2002.79398 138.019045,2004.99998 C138.019045,2007.20598 136.216504,2008.99998 134,2008.99998 M137.775893,2009.67298 C139.370449,2008.39598 140.299854,2006.33098 139.958235,2004.06998 C139.561354,2001.44698 137.368965,1999.34798 134.722423,1999.04198 C131.070116,1998.61898 127.971432,2001.44898 127.971432,2004.99998 C127.971432,2006.88998 128.851603,2008.57398 130.224107,2009.67298 C126.852128,2010.93398 124.390463,2013.89498 124.004634,2017.89098 C123.948368,2018.48198 124.411563,2018.99998 125.008391,2018.99998 C125.519814,2018.99998 125.955881,2018.61598 126.001095,2018.10898 C126.404004,2013.64598 129.837274,2010.99998 134,2010.99998 C138.162726,2010.99998 141.595996,2013.64598 141.998905,2018.10898 C142.044119,2018.61598 142.480186,2018.99998 142.991609,2018.99998 C143.588437,2018.99998 144.051632,2018.48198 143.995366,2017.89098 C143.609537,2013.89498 141.147872,2010.93398 137.775893,2009.67298" id="profile-[#1341]"> </path> </g> </g> </g> </g></svg>
                </a></li>
          <?php
              }
          ?>
            <li><a href="../html-otros/index.php?action=logout" class="boton boton-secundario">Cerrar sesión</a></li>
          <?php
            } else {
          ?>
            <li><a href="../html-heymmy/registro.php" class="boton boton-primario">Registrarse</a></li>
            <li><a href="../html-otros/login.php" class="boton boton-secundario">Iniciar sesión</a></li>
          <?php
            }
          ?>

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
  <footer style="position: relative;">
    <div class="contenedor">
      <div class="columna-pie-de-index">
        <p>&copy; 2024 AgroConnect</p>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <li><a href="../html-otros/herramientas.php">Herramientas</a></li>
            <li><a href="../html-heymmy/certificaciones.php">Certificaciones</a></li>
            <li><a href="../html-otros/condiciones.php">Términos y condiciones</a></li>
          </ul>
        </nav>
      </div>
      <div class="columna-pie-de-index">
        <nav>
          <ul>
            <?php
              // Si el usuario está logueado, mostrar el botón de cerrar sesión
              if (isset($_SESSION['email'])) {
            ?>
              <li><a href="../html-otros/index.php?action=logout" class="boton boton-secundario">Cerrar sesión</a></li>
            <?php
              } else {
            ?>
              <li><a href="../html-heymmy/registro.php" class="boton boton-primario">Registrarse</a></li>
              <li><a href="../html-otros/login.php" class="boton boton-secundario">Iniciar sesión</a></li>
            <?php
              }
            ?>  

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