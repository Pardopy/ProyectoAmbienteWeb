<?php
    // Imports
    require_once('../../Controller/productosController.php');
    require_once('../../Controller/categoriaController.php');
    
    // Iniciar la variable de categorias
    $listadoCategorias = categoriaController::getAllCategories();

    session_start();
    print_r($_SESSION);

    // Verificar si se ha enviado el formulario de busqueda
     if (isset($_GET['action'])) {
        
        switch ($_GET['action']) {
            case 'searchProducts':
                if ($_POST['categoria_id'] == 0 && $_POST['keyword'] == "") {
                    $listadoProductos = productosController::getAllProducts();
                } elseif ($_POST['categoria_id'] != 0 && $_POST['keyword'] == "") {
                    $listadoProductos = productosController::getProductsByCategory($_POST);
                } elseif ($_POST['categoria_id'] == 0 && $_POST['keyword'] != "") {
                    $listadoProductos = productosController::getProductsByName($_POST);
                } elseif ($_POST['categoria_id'] != 0 && $_POST['keyword'] != "") {
                    $listadoProductos = productosController::getProductsByCategoryAndName($_POST);
                }

                break;

            case 'addToCart':
                // Se verifica si el carrito de compras existe
                if (!isset($_SESSION['cart'])) {

                    // Si no existe, se crea
                    $_SESSION['cart'] = array();

                    // Se agrega el producto al carrito
                    array_push($_SESSION['cart'], array(
                        'idProducto' => $_POST['idProducto'],
                        'cantidad' => 1
                    ));
                    // print_r($_SESSION['cart']);

                    // Se muestra un mensaje de exito
                    echo "<script>alert('Producto agregado al carrito (Carrito se crea)');</script>";

                    // Se redirige a la pagina de productos
                    header('Location: productos.php');
                    
                } else {
                    // Se verifica si el producto ya existe en el carrito
                    $found = false;

                    foreach ($_SESSION['cart'] as $item) {
                        if ($item['idProducto'] == $_POST['idProducto']) {
                            // Si ya existe, se incrementa la cantidad
                            $item['cantidad'] += 1;
                            $found = true;
                            
                            // Se busca y actualiza la cantidad del item del subarray en la variable de sesion
                            foreach ($_SESSION['cart'] as $key => $value) {
                                if ($value['idProducto'] == $_POST['idProducto']) {
                                    $_SESSION['cart'][$key]['cantidad'] = $item['cantidad'];
                                }
                            }

                            // Se actualiza la cantidad del item del subarray en la variable de sesion
                            // $_SESSION['cart'][$item['producto_id'] - 1]['cantidad'] = $item['cantidad'];

        
                            // Se muestra un mensaje de exito
                            echo "<script>alert('Producto agregado al carrito (Carrito se actualiza en la cantidad)');</script>";
                            // print_r($_SESSION['cart']);
                            // Se redirige a la pagina de productos
                            header('Location: productos.php');

                            break;
                        }
                    }

                    if (!$found) {
                        // Si no existe, se agrega al carrito
                        array_push($_SESSION['cart'], array(
                            'idProducto' => $_POST['idProducto'],
                            'cantidad' => 1
                        ));
                        // print_r($_SESSION['cart']);
                        // Se muestra un mensaje de exito
                        echo "<script>alert('Producto agregado al carrito (Se añade al carrito el nuevo)');</script>";

                        // Se redirige a la pagina de productos
                        header('Location: productos.php');

            

                    }
                }




                break;
        }
            
     } else {
        $listadoProductos = productosController::getAllProducts();
     }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AgroConnect - Catálogo</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- CSS -->
  <link rel="stylesheet" href="styleKevin.css">

  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

  <!-- Breadcrumb Block -->
  <section style="margin-bottom: 0;">
    <div class="py-5 color5">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h1 class="fw-bold">Catálogo de Productos</h1>
          <svg width="64px" height="64px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M9 11V6C9 4.34315 10.3431 3 12 3C13.6569 3 15 4.34315 15 6V10.9673M10.4 21H13.6C15.8402 21 16.9603 21 17.816 20.564C18.5686 20.1805 19.1805 19.5686 19.564 18.816C20 17.9603 20 16.8402 20 14.6V12.2C20 11.0799 20 10.5198 19.782 10.092C19.5903 9.71569 19.2843 9.40973 18.908 9.21799C18.4802 9 17.9201 9 16.8 9H7.2C6.0799 9 5.51984 9 5.09202 9.21799C4.71569 9.40973 4.40973 9.71569 4.21799 10.092C4 10.5198 4 11.0799 4 12.2V14.6C4 16.8402 4 17.9603 4.43597 18.816C4.81947 19.5686 5.43139 20.1805 6.18404 20.564C7.03968 21 8.15979 21 10.4 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </div>
      </div>
    </div>
  </section>

    <main class="main-bg-soporte">
        <div class="div-bg-soporte pb-5" style="min-height: 82%">
            <!-- Busqueda Avanzada -->
            
            <section class="position-sticky">
                <div class="card position-absolute top-0 end-0 me-5 mt-5" style="width: 20rem;">
                    <div class="card-body">
                        <div class="search-container">
                            <h3>Búsqueda</h3>
                            <form action="../html-kevin/productos.php?action=searchProducts" method="POST"
                                id="search-form">
                                <label for="keyword">Palabra Clave:</label>
                                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Ingrese palabra clave">
                    
                                <label for="category">Categoría:</label>
                                <select class="form-select mb-3" name="categoria_id" id="categoria_id" aria-label="categoria_id">
                                    <option value="0">Sin Categoría</option>
                                    <?php 
                                        foreach ($listadoCategorias as $categoria) {
                                    ?>
                                    <option value="<?=$categoria['categoria_id']?>"><?=$categoria['nombre_categoria']?></option>
                                    <?php 
                                        }
                                    ?>
                                  </select>

                                <button type="submit" class="btn text-light fw-bold" style="background-color: #648A64;" onclick="performSearch()">Buscar</button>
                            </form>
                            <div id="search-results" class="search-results"></div>
                        </div>
                    </div>
                </div>
                <script src="script.js"></script>
            </section>
            

            <!-- <div class="container-fluid d-flex justify-content-center align-items-center"> -->
            <div class="container text-center pt-5">
                
                <?php
                    if ($listadoProductos == null) {
                ?>

                <div class="container-fluid text-center">
                    <div class="justify-content-center align-items-center">
                        <h1 class="text-center text-light position-absolute top-50 start-50 translate-middle">No se encontraron productos :(</h1>
                    </div>
                </div>
                <?php
                    } else {
                ?>

                    <div class="row">
                        <?php
                            foreach ($listadoProductos as $producto) {
                        ?>
                        <div class="col-lg-4 col-md-12">
                            <!-- Tarjeta de Producto -->
                            <div class="card border-0 shadow rounded-0 mb-5" style="width: 18rem;">
                                <img src="<?=$producto['imagen_producto']?>" class="card-img-top rounded-0" alt="...">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-10">
                                            <!-- URL con el id del producto a detalleProducto -->
                                            
                                            <h4 class="card-title"><a class="text-decoration-none text-dark"href="../html-kevin/detalleProducto.php?idProducto=<?=$producto['producto_id']?>"><?=$producto['nombre_producto']?></a></h4>
                                            <p class="card-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-warning" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                </svg>
                                                (4)
                                            </p>
                                        </div>
                                        <div class="col-2 d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
                                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
                                                <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center text-center g-0">
                                    <div class="col-4">
                                        <h5>$<?=$producto['precio']?></h5>
                                    </div>
                                    <div class="col-8">
                                        <!-- <a href="#" class="btn btn-dark w-100 p-3 rounded-0 text-warning">AÑADIR AL CARRITO</a> -->
                                        <form   action="../html-kevin/productos.php?action=addToCart" method="POST"
                                                id="addToCart">
                                                <input type="text" name="idProducto" id="idProducto" value="<?=$producto['producto_id']?>" required hidden>

                                            <button type="submit" class="btn text-light w-100 p-3 rounded-0 " style="background-color: #648A64;">AÑADIR AL CARRITO</button>    
                                        </form>
                                    
                                    </div>
                                </div>
                            </div>                
                        </div>
                        <?php
                            }
                        ?>

                    </div>
                <?php
                    }
                ?>
                

                    

            </div>
        </div>
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