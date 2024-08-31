<?php
    // Imports
    require_once('../../Controller/pedidoController.php');
    require_once('../../Controller/productosController.php');

    // Iniciar la sesión
    session_start();

    // Verificar si el usuario está logueado
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: ../html-otros/login.html');
    } else {
        $idUsuario = $_SESSION['idUsuario'];

        $pedidos = pedidoController::getOrdersByUserId($_SESSION);

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consultar Registro de Usuarios - AgroConnect</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <!-- BootStrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* Estilos generales */
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #f0f2f5;
      color: #000;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    header {
      background-color: #213435;
      color: #fff;
      padding: 10px 0;
    }

    .contenedor {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
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

    /* Contenedor principal blanco */
    .contenedor-principal {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 1200px;
      margin: 20px auto;
      display: flex;
      justify-content: center;
    }

    h1 {
      color: #213435;
      margin-bottom: 20px;
      text-align: center;
    }

    /* Estilos de la lista de usuarios */
    .lista-usuarios {
      margin-top: 20px;
      width: 100%;
    }

    .lista-usuarios table {
      width: 100%;
      border-collapse: collapse;
    }

    .lista-usuarios table, th, td {
      border: 1px solid #ccc;
    }

    .lista-usuarios th, td {
      padding: 12px;
      text-align: left;
      color: #000; /* Cambiado a negro */
    }

    .lista-usuarios th {
      background-color: #213435;
      color: #fff;
    }

    .lista-usuarios tr:nth-child(even) {
      background-color: #f2f2f2;
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

    <div class="contenedor-principal">
      <div class="lista-usuarios">
        <h1>Lista de Pedidos</h1>
        <?php
          if (count($pedidos) > 0) {
        ?>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php
                  foreach ($pedidos as $pedido) {
                    $data = array('idPedido' => $pedido['pedido_id']);

                    $detallesPedido = pedidoController::getOrderDetails($data);
                    // print_r($detallesPedido);
              ?>
                <tr>
                  <td><?=$pedido['pedido_id']?></td>
                  <td><?=$pedido['fecha_pedido']?></td>
                  <td><?=$pedido['estado_pedido']?></td>
                  <td>
                    <a href="detalleUsuario.html" ></a>
                    <!-- Button trigger modal -->
                    <button type="button" class="boton boton-primario" style="border: 0px;" data-bs-toggle="modal" data-bs-target="<?="#exampleModal" . $pedido['pedido_id']?>">
                      Ver detalles
                    </button>

                    <!-- Modal -->
                      <div class="modal fade" id="<?="exampleModal" . $pedido['pedido_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <table>
                                <thead>
                                  <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    foreach ($detallesPedido as $detalle) {
                                      $data = array('idProducto' => $detalle['producto_id']);
                                      $producto = productosController::getProductById($data);
                                      $producto = $producto[0];
                                  ?>
                                    <tr>
                                      <td><?=$producto['nombre_producto']?></td>
                                      <td><?=$detalle['cantidad']?></td>
                                      <td><?=$producto['precio']?></td>
                                    </tr>
                                  <?php
                                    }
                                  ?>
                                </tbody>
                              </table>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="boton boton-primario" style="border: 0px;" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>

                  </td>
                  
                </tr>
              <?php
                  }
              ?>

            </tbody>
          </table>
        <?php
          } else {
        ?>
          <div class="d-flex justify-content-center">
            <p class="text-dark">No hay pedidos registrados</p>
          </div>
        <?php
          }
        ?>
      </div>
    </div>
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

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- <script src="consultar.js"></script> -->
</body>
</html>
