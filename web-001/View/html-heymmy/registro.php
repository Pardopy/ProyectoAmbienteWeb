<?php
    // Imports
    require_once('../../Controller/usuarioController.php');

    if (isset($_GET['action'])) {
      
      switch ($_GET['action']) {
        case 'register':
            usuarioController::addUser($_POST);
            print_r($_POST);

            session_start();
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['tipoUsuario'] = $_POST['tipoUsuario'];

            $idUsuario = usuarioController::getUserByEmail($_POST);
            $_SESSION['idUsuario'] = $idUsuario[0]['usuario_id'];

            print_r($_SESSION);

            // Verificar si el perfil es comprador o agricultor para reedirigirlo
            // a la página correspondiente
            if ($_POST['tipoUsuario'] == 'Comprador') {
              header('Location: ../html-kevin/perfilComprador.php');
            } else {
              header('Location: perfilAgricultor.php');
            }

            break;
      }
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse - AgroConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Estilos */
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      color: #000;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
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

    /* Formulario de registro */
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
      max-width: 400px;
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
    .formulario-registro select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .formulario-registro button {
      width: 100%;
      background-color: #213435;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .formulario-registro button:hover {
      opacity: 0.8;
    }

    .formulario-registro p {
      margin-top: 10px;
    }

    .formulario-registro a {
      color: #213435;
      text-decoration: none;
    }

    .formulario-registro a:hover {
      text-decoration: underline;
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
        <h2>Registrarse en AgroConnect</h2>
        <form action="registro.php?action=register" method="POST"
              id="registerForm">
          <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="tipoUsuario">Soy:</label>
            <select id="tipoUsuario" name="tipoUsuario" class="form-control" required>
              <option value="Agricultor">Agricultor</option>
              <option value="Comprador">Comprador</option>
            </select>
          </div>
          <button type="submit" class="boton boton-primario">Registrarse</button>
          <p>¿Ya tienes una cuenta? <a href="login.html">Inicia sesión aquí</a></p>
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

  <!-- <script src="registro.js"></script> -->
</body>
</html>
