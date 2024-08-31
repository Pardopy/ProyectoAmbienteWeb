<?php
    require_once('../../Controller/loginController.php');

    // Iniciar la sesión
    session_start();

    if (isset($_GET['action'])) {
      switch ($_GET['action']) {
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
  <title>Términos y Condiciones - AgroConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

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

<main>
  <section class="contenido-legal">
    <div class="contenedor">
      <h1>Términos y Condiciones de Uso</h1>
      <div class="terminos">
        <h2>1. Aceptación de los Términos</h2>
        <p>Al acceder y utilizar AgroConnect, usted acepta estar sujeto a estos términos y condiciones en su totalidad.</p>

        <h2>2. Uso Permitido</h2>
        <p>Está permitido utilizar AgroConnect para conectarse con compradores y vender productos agrícolas bajo los términos acordados.</p>

        <h2>3. Responsabilidades del Usuario</h2>
        <p>Los usuarios deben mantener la confidencialidad de su cuenta y ser responsables de todas las actividades realizadas bajo su cuenta.</p>

        <h2>4. Modificaciones</h2>
        <p>Nos reservamos el derecho de modificar estos términos en cualquier momento sin previo aviso.</p>
      </div>
    </div>
  </section>
</main>

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
        <nav style="margin-left: 20vh;">
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

</body>
</html>
