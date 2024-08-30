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
  <header>
    <div class="contenedor">
      <a href="index.html" class="logotipo">AgroConnect</a>
      <nav>
        <ul>
          <li><a href="index.html">Inicio</a></li>
          <li><a href="acerca.html">Acerca de</a></li>
          <li><a href="productos.html">Productos</a></li>
          <li><a href="comofunciona.html">Cómo funciona</a></li>
          <li><a href="registro.html" class="boton boton-primario">Registrarse</a></li>
          <li><a href="login.html" class="boton boton-secundario">Iniciar sesión</a></li>
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
          <a style="text-decoration: none; color: #fff;" href="../html-otros/ConfigCuenta.html"><button type="button">Modificar credenciales</button></a>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <div class="contenedor-footer">
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
            <li><a href="registro.html">Registrarse</a></li>
            <li><a href="login.html">Iniciar sesión</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </footer>
</body>
</html>
