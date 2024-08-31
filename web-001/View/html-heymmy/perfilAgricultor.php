<?php
    // Imports
    require_once('../../Controller/usuarioController.php');

    // Iniciar la sesión
    session_start();

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: ../html-otros/login.html');
    } else {
        $idUsuario = $_SESSION['idUsuario'];

        // Verificar si el usuario ya tiene un perfil
        $profile = usuarioController::getProfileByUserId($_SESSION);

        // Si ya tiene un perfil, llenar los campos con la información
        if ($profile) {
            $nombre = $profile[0]['nombre_completo'];
            $telefono = $profile[0]['telefono'];
            $campoAdicional = $profile[0]['campo_adicional'];
            $biografia = $profile[0]['biografia'];
        } else {
            $nombre = '';
            $telefono = '';
            $campoAdicional = '';
            $biografia = '';
        }

        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'addProfile':
                    // Si el perfil ya existe, actualizarlo
                    if ($profile) {
                        usuarioController::updateProfile($_POST);
                        header('Location: ../html-kevin/perfil-guardado.php');

                    } else {
                        usuarioController::addProfile($_POST);
                        header('Location: ../html-kevin/perfil-guardado.php');
                    }



                    break;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroConnect - Perfil</title>

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      color: #000;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-image: url('https://previews.123rf.com/images/alessandrobiascioli/alessandrobiascioli2303/alessandrobiascioli230300036/201097467-grupo-de-agricultores-que-trabajan-en-tierras-agr%C3%ADcolas-concepto-de-estilo-de-vida-de-los.jpg');
      background-size: cover;
      background-position: center;
    }

    .contenedor {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    /* Header */
    header {
      background-color: #213435;
      color: #fff;
      padding: 10px 0;
    }

    .logotipo {
      color: #fff;
      text-decoration: none;
      font-size: 24px;
      font-weight: bold;
    }

    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
    }

    nav ul li {
      margin: 0 10px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    nav ul li a:hover {
      text-decoration: underline;
    }

    /* Formulario de perfil */
    .seccion-registro {
      text-align: center;
      margin: 50px auto;
      flex: 1;
    }

    .formulario-registro {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      margin: 0 auto;
    }

    .formulario-registro h2 {
      color: #213435;
    }

    .formulario-registro label {
      display: block;
      text-align: left;
      margin-top: 10px;
    }

    .formulario-registro input,
    .formulario-registro textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .formulario-registro button {
      width: 48%;
      background-color: #213435;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      margin-right: 4%;
    }

    .formulario-registro button:hover {
      opacity: 0.8;
    }

    .formulario-registro .form-group {
      margin-bottom: 15px;
    }

    /* Footer */
    footer {
      background-color: #213435;
      color: #fff;
      padding: 20px 0;
      text-align: center;
      width: 100%;
      position: relative;
      bottom: 0;
    }

    .contenedor-footer {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 10px;
    }

    .columna-pie-de-index {
      width: 33.33%;
      box-sizing: border-box;
      padding: 0 10px;
      text-align: center;
    }

    .columna-pie-de-index p,
    .columna-pie-de-index ul {
      margin: 0;
    }

    .columna-pie-de-index nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }

    .columna-pie-de-index nav ul li {
      margin: 5px 0;
    }

    .columna-pie-de-index nav ul li a {
      color: #fff;
      text-decoration: none;
      display: block;
    }

    .columna-pie-de-index nav ul li a:hover {
      text-decoration: underline;
    }
  </style>
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
    <section class="seccion-registro">
      <div class="formulario-registro">
        <h2>Perfil del Agricultor</h2>
        <form action="?action=addProfile" method="POST" enctype="multipart/form-data"
              id="profileForm">
          <input type="text" id="idUsuario" name="idUsuario" value="<?=$idUsuario?>" required hidden>

          <div class="form-group">
            <label for="fotoPerfil">Fotografía del perfil:</label>
            <input type="file" id="fotoPerfil" name="fotoPerfil">
          </div>
          <div class="form-group">
            <label for="nombre">Nombre completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?=$nombre?>" required>
          </div>
          <div class="form-group">
            <label for="telefono">Número de teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?=$telefono?>" required>
          </div>
          <div class="form-group">
            <label for="campoAdicional">Tipo de productos:</label>
            <input type="text" id="campoAdicional" name="campoAdicional" value="<?=$campoAdicional?>" required>
          </div>
          <div class="form-group">
            <label for="biografia">Biografía:</label>
            <textarea id="biografia" name="biografia" rows="4" required><?=$biografia?></textarea>
          </div>
          <button type="submit">Guardar cambios</button>
          <a style="text-decoration: none; color: #fff;" href="../html-heymmy/modificarCredenciales.php"><button type="button" style="font-weight: bold;">Modificar credenciales</button></a>
        </form>
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
