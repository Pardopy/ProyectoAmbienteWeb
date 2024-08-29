<?php
    // Imports
    require_once('../../Controller/productosController.php');
    require_once('../../Controller/categoriaController.php');
    
    // Iniciar la variable de categorias
    $listadoCategorias = categoriaController::getAllCategories();

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
        <div class="div-bg-soporte pb-5" style="height: 75%;">
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
                                            <h4 class="card-title"><a class="text-decoration-none text-dark" href="../html-otros/DetalleProducto.html"><?=$producto['nombre_producto']?></a></h4>
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
                                        <a href="#" class="btn text-light w-100 p-3 rounded-0 " style="background-color: #648A64;">AÑADIR AL CARRITO</a>
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
                    

                    <!-- <div class="col-lg-4 col-md-12 mb-4"> -->
                        <!-- Tarjeta de Producto -->
                        <!-- <div class="card border-0 shadow rounded-0" style="width: 18rem;">
                            <img src="https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0" class="card-img-top rounded-0" alt="...">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <h4 class="card-title">Nombre Producto</h4>
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
                                    <h5>$123</h5>
                                </div>
                                <div class="col-8">
                                    <a href="#" class="btn btn-dark w-100 p-3 rounded-0 text-warning">AÑADIR AL CARRITO</a>
                                    <a href="#" class="btn text-light w-100 p-3 rounded-0 " style="background-color: #648A64;">AÑADIR AL CARRITO</a>
                                </div>
                            </div>
                        </div>                
                    </div> -->
<!-- 
                <div class="row">
                    <div class="col-lg-4 col-md-12"> -->
                        <!-- Tarjeta de Producto -->
                        <!-- <div class="card border-0 shadow rounded-0" style="width: 18rem;">
                            <img src="https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0" class="card-img-top rounded-0" alt="...">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10">
                                        <h4 class="card-title">Nombre Producto</h4>
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
                            <div class="row align-items-center g-0">
                                <div class="col-4">
                                    <h5>$123</h5>
                                </div>
                                <div class="col-8"> -->
                                    <!-- <a href="#" class="btn btn-dark w-100 p-3 rounded-0 text-warning">AÑADIR AL CARRITO</a> -->
                                    <!-- <a href="#" class="btn text-light w-100 p-3 rounded-0 " style="background-color: #648A64;">AÑADIR AL CARRITO</a>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div> -->

                    

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
      <div c    lass="columna-pie-de-index">
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