<?php
    // Imports
    require_once('../../Controller/loginController.php');

    // Se verifica si se ha enviado un action por GET
    if (isset($_GET['action'])) {
        
      // Se verifica el valor del action
      switch ($_GET['action']) {

          // Si el action es login
          case 'login':

              // Se llama a la función login del controller
              loginController::login($_POST);
              break;
          
          // Si el action es logout
          case 'logout':

              // Se llama a la función logout del controller
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
  <title>Iniciar Sesión - AgroConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <script src="js.js"></script>

  <!-- Header modificado -->
  <header>
    <div class="contenedor">
      <a href="../html-otros/Index.html" class="logotipo">AgroConnect</a>
      
      <nav>
        <ul>
          <li><a href="../html-otros/index.html">Inicio</a></li>
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

  <main>
    <section class="seccion-inicio-sesion">
      <div class="contenedor">
        <div class="formulario-inicio-sesion">
          <h2>Iniciar Sesión</h2>
          <form action="login.php?action=login" method="POST"
                id="login">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="boton boton-primario">Iniciar Sesión</button>
          </form>
          <p>¿No tienes una cuenta? <a href="registro.html">Regístrate aquí</a></p>
        </div>
      </div>
    </section>
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
  
</body>
</html>
