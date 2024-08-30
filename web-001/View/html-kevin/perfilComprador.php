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
                        header('Location: perfil-guardado.html');

                    } else {
                        usuarioController::addProfile($_POST);
                        header('Location: perfil-guardado.html');
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

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- CSS -->
  <link rel="stylesheet" href="styleKevin.css">

</head>



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

    <main class="main-bg-soporte">
        
      <div class="div-bg-soporte">          
        <div class="container py-5">
        
          <section class="seccion-registro">
            <div class="formulario-registro">
              <h2 style="font-size: 1.5rem; font-weight: 650;">Perfil de Comprador </h2>
              <form action="?action=addProfile" method="POST" enctype="multipart/form-data"
                    id="profileForm">

                <input type="text" id="idUsuario" name="idUsuario" value="<?=$idUsuario?>" required hidden>

                <div class="form-group">
                  <label for="fotoPerfil">Fotografía del perfil:</label>
                  <input type="file" id="fotoPerfil" name="fotoPerfil" style="color: #fff;">
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
                  <label for="campoAdicional">Dirección:</label>
                  <input type="text" id="campoAdicional" name="campoAdicional" value="<?=$campoAdicional?>" required>
                </div>
                <div class="form-group">
                  <label for="biografia">Biografía:</label>
                  <textarea id="biografia" name="biografia" rows="4" required><?=$biografia?></textarea>
                </div>
                <button style="font-weight: bold;" type="submit">Guardar cambios</button>
                <a style="text-decoration: none; color: #fff;" href="../html-otros/ConfigCuenta.html"><button type="button" style="font-weight: bold;">Modificar credenciales</button></a>
              </form>
            </div>
          </section>
                
        </div>
      </div>

    </main>
  


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


  