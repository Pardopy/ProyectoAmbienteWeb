<?php
    // Imports
    require_once('../../Controller/productosController.php');
    require_once('../../Controller/pedidoController.php');

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

            }

          }
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
