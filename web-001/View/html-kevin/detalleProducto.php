
<?php
    // Imports
    require_once('../../Controller/productosController.php');

    // Obtener el id del producto de la URL
    $idProducto = $_GET['idProducto'];

    // Llamar al metodo del controlador para obtener el producto por id
    $productos = productosController::getProductById($_GET);
    
    if ($productos) {
        $producto = $productos[0];
    } else {
        // Si no se encuentra el producto, redirigir al index
        header('Location: ../html-kevin/productos.php');
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

  <!-- Header modificado -->
  <header>
    <div class="contenedor">
      <a href="../html-otros/Index.html" class="logotipo">AgroConnect</a>
      
      <nav>
        <ul>
          <li><a href="../html-otros/index.php">Inicio</a></li>
          <li><a href="../html-kevin/productos.php">Productos</a></li>
          <li><a href="../html-otros/GestionPedidos.html">Pedidos</a></li>
          <li><a href="../html-heymmy/Foro.html">Foro</a></li>
          <li><a href="../html-kevin/soporte.php">Soporte</a></li>
          <li><a href="../html-heymmy/Registro.html" class="boton boton-primario">Registrarse</a></li>
          <li><a href="../html-otros/login.html" class="boton boton-secundario">Iniciar sesión</a></li>
        </ul>
      </nav>
    </div>
  </header>

    <main class="main-bg-soporte">
        <div class="div-bg-soporte d-flex" style="height: 83vh;">
            <div class="container py-5">

        
                <div class="d-flex align-items-center justify-content-center h-100">
                  <div class="card mb-3" style="height: 40rem; width: 50rem;">
                    <div class="d-flex justify-content-center mt-4">
                      <img class="rounded" src="https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0" class="card-img-top" style="max-height: 40vh; max-width: min-content;" alt="Imagen del producto">
                    </div>
                    <div class="card-body mt-4 text-center">
                      <h5 class="card-title"><?=$producto['nombre_producto']?></h5>
                      <p class="card-text"><?=$producto['descripcion']?></p>
                      <p class="card-text fw-bold">$<?=$producto['precio']?></p>
                  </div>
                  <!-- Añadir al carrito -->
                  <div class="d-flex justify-content-center mb-4">
                    <a href="#" class="boton boton-primario">Añadir al carrito</a>
                  </div>
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
