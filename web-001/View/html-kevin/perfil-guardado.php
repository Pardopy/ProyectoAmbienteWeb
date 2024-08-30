<?php
    // Iniciar la sesión
    session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
    // Si el usuario es agricultor, redirigirlo a la página de perfil de agricultor
    if ($_SESSION['tipoUsuario'] == 'Agricultor') {
  ?>
    <meta http-equiv="refresh" content="3;url=../html-heymmy/perfilAgricultor.php">
  <?php
    } else {
  ?> 
    <meta http-equiv="refresh" content="3;url=perfilComprador.php">
  <?php
    }
  ?>
  
  <title>AgroConnect - Pefil</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- CSS -->
  <link rel="stylesheet" href="styleKevin.css">

  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

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

    <main class="main-bg-soporte">
        <div class="div-bg-soporte d-flex" style="height: 75vh;">
            <div class="container py-5">

                <div class="d-flex align-items-center justify-content-center h-100">
                    <div class="text-light">
                        <h2 class="fw-bold">Perfil guardado con éxito.</h2>
                        <p>Los datos del perfil han sido guardados. Puede modificarlos en cualquier momento.</p>
                    </div>
                </div>


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
