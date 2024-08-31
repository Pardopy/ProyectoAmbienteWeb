<?php
    // Imports
    require_once('../../Controller/productosController.php');
    require_once('../../Controller/pedidoController.php');
    require_once('../../Controller/loginController.php');

    session_start();
    
    // Verificar si el carrito existe
    if (!isset($_SESSION['cart'])) {
        header('Location: ../html-kevin/productos.php');
    } else {
        $cart = $_SESSION['cart'];
        $total = 0;
    }

    // Se suman los totales de los productos en el carrito


    // Verificar si se solicita eliminar un producto del carrito
    if (isset($_GET['action'])) {

      switch ($_GET['action']) {
        case 'removeItem':

          // Se busca el item en el carrito y se elimina
          foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['idProducto'] == $_POST['idProducto']) {
              unset($_SESSION['cart'][$key]);
              break;
            }
          }

          header('Location: carrito.php');

          break;

        case 'checkout':
          // Se verifica si el usuario esta logueado
          if (!isset($_SESSION['idUsuario'])) {
            header('Location: ../html-otros/login.php');
          } else {
            // Se crea el pedido
            $pedido = pedidoController::addOrder($_SESSION);
            $pedido = $pedido[0];
            print_r($pedido);

            // Se insertan los detalles del pedido
            foreach ($_SESSION['cart'] as $item) {
              $producto = productosController::getProductById($item);
              $producto = $producto[0];
              
              // Se crea el array con los datos del detalle
              $data = array(
                'idPedido' => $pedido['pedido_id'],
                'idProducto' => $item['idProducto'],
                'cantidad' => $item['cantidad'],
                'precio' => $producto['precio']
              );

              // Se inserta el detalle del pedido
              pedidoController::addOrderDetails($data);

              // Se limpia el carrito
              unset($_SESSION['cart']);

              header('Location: ../html-heymmy/consultar.php');

            }

          }
          break;

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
  <title>AgroConnect - Carrito</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
  <!-- CSS -->
  <link rel="stylesheet" href="styleKevin.css">

  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <!-- Icons -->
  <script src="https://kit.fontawesome.com/f2f9e1c6d1.js" crossorigin="anonymous"></script>

</head>

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
          <h1 class="fw-bold">Carrito de Compra</h1>
          <svg fill="#000000" width="64px" height="64px" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M891 308H340q-6 0-10.5-4t-5.5-10l-32-164q-2-14-12-22.5T256 99H110q-15 0-25.5 10.5T74 135v5q0 15 10.5 26t25.5 11h102q4 0 7 2.5t4 6.5l102 544q3 19 20 28 8 5 18 5h17q-22 25-21 58.5t25 56.5 57.5 23 58-23 25.5-56.5-22-58.5h186q-23 25-21.5 58.5T693 878t57.5 23 57.5-23 25-56.5-21-58.5h17q15 0 25.5-10.5T865 727v-8q0-15-11-25.5T828 683H409q-6 0-10.5-4t-5.5-9l-10-54q-1-8 4-14t12-5h460q13 0 22.5-8t11.5-21l33-219q3-16-7.5-28.5T891 308z"></path></g></svg>
        </div>
      </div>
    </div>
  </section>

  <main class="main-bg-soporte">
    <div class="div-bg-soporte">

      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">

                <!-- Listado de Carrito -->
              <div class="card">
                <div class="card-body p-4">
      
                  <div class="row">
      
                    <div class="col-lg-7">
                      <h5 class="mb-3"><a href="javascript:history.go(-1)" class="text-body">
                        <i class="fa-solid fa-arrow-left"></i>
                        Volver</a></h5>
                      <hr>
      
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                          <p class="mb-1">Lista de productos</p>
                        </div>
                      </div>

                      <?php
                        if (count($cart) == 0) {
                      ?>
                        <div class="alert alert-warning" role="alert">
                          No hay productos en el carrito.
                        </div>
                      <?php
                        } else {
                      ?>

                        <?php
                          foreach ($cart as $item) {
                              $producto = productosController::getProductById($item);
                              $producto = $producto[0];

                              $total += $producto['precio'] * $item['cantidad'];
                              $itemTotal = $producto['precio'] * $item['cantidad'];

                        ?>
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                  <div>
                                    <img
                                      src="https://unavatar.io/product1"
                                      class="img-fluid rounded-3" alt="Producto listado" style="width: 65px;">
                                  </div>
                                  <div class="ms-3">
                                    <h5><?=$producto['nombre_producto']?></h5>
                                    <p class="small mb-0"><?=$producto['descripcion']?></p>
                                  </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                  <div style="width: 50px;">
                                    <h5 class="fw-normal mb-0"><?=$item['cantidad']?></h5>
                                  </div>
                                  <div style="width: 80px;">
                                    <h5 class="mb-0">$<?=$itemTotal?></h5>
                                  </div>
                                    <form action="?action=removeItem" method="POST"
                                          id="removeFromCart">
                                          <input type="text" name="idProducto" id="idProducto" value="<?=$producto['producto_id']?>" required hidden>
                                      <button type="submit" class="text-danger" style="background-color: transparent;"><i class="fas fa-trash-alt"></i></button>
                                      <!-- <a href="#!" class="text-danger"><i class="fas fa-trash-alt"></i></a> -->
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php
                          }
                        }
                        ?>
                         
      
                    </div>
                    <!-- Detalles de Pago -->
                    <div class="col-lg-5">
      
                      <div class="card text-white rounded-3" style="background-color: #648A64;">
                        <div class="card-body">
                          <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Detalles de pago</h5>
                            <img src="https://unavatar.io/avatar00"
                              class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                          </div>
      
                          <p class="small mb-2">Tipos de tarjeta</p>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-visa fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i
                              class="fab fa-cc-amex fa-2x me-2"></i></a>
                          <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>
      
                          <form class="mt-4">
                            <div class="form-outline form-white mb-4">
                              <input type="text" id="nombre" class="form-control form-control-lg" siez="17"
                                placeholder="John Doe" />
                              <label class="form-label" for="typeName">Nombre del Titular</label>
                            </div>

                            <div class="form-outline form-white mb-4">
                              <input type="text" id="numeroTarjeta" class="form-control form-control-lg" siez="17"
                                placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                              <label class="form-label" for="typeText">Número de Tarjeta</label>
                            </div>
      
                            <div class="row mb-4">
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                  <input type="text" id="expiracion" class="form-control form-control-lg"
                                    placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                                  <label class="form-label" for="typeExp">Expiración</label>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-outline form-white">
                                  <input type="password" id="cvv" class="form-control form-control-lg"
                                    placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                  <label class="form-label" for="typeText">CVV</label>
                                </div>
                              </div>
                            </div>
      
                          </form>
      
                          <hr class="my-4">
      
                          <div class="d-flex justify-content-between">
                            <p class="mb-2">Subtotal</p>
                            <p class="mb-2">$<?=$total?></p>
                          </div>
      
                          <div class="d-flex justify-content-between">
                            <p class="mb-2">Envío</p>
                            <p class="mb-2">$<?=$total * 0.15?></p>
                          </div>
      
                          <div class="d-flex justify-content-between mb-4">
                            <p class="mb-2">Total(Incl. IVA)</p>
                            <p class="mb-2">$<?=$total * 1.15?></p>
                          </div>

                          <form action="?action=checkout" method="POST"
                                  id="checkoutForm">
                            <button  type="submit" class="btn btn-outline-light text-light fw-bold btn-lg">
                              <div class="d-flex justify-content-between">
                                <span class="me-2">$<?=$total * 1.15?></span>
                                <span>Pagar <i class="fas fa-long-arrow-alt-right ms-1"></i></span>  
                              </div>
                            </button>
                          </form>
      
                        </div>
                      </div>
      
                    </div>
      
                  </div>
      
                </div>
              </div>
            </div>
          </div>
        

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
