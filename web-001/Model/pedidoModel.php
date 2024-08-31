<?php
    // Imports
    require_once(__DIR__ . '/connModel.php');

    class pedidoModel {
        // Metodo para insertar un nuevo pedido
        public static function addOrder($data) {
                
                try {
                    // Formatted string para la consulta
                    $formattedStr = "'" . $data['idUsuario'] . "', 'Pendiente'";
    
                    // Ejecutar la consulta y guardar el resultado
                    $result = connModel::fetchData("CALL InsertPedidoAndReturn($formattedStr);");
    
                    return $result;
    
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
    
                }
        }

        // Metodo para insertar detalles de un pedido
        public static function addOrderDetails($data) {
            
            try {
                
                // Formatted string para la consulta
                $formattedStr = "'" . $data['idPedido'] . "', '" . $data['idProducto'] . "', '" . $data['cantidad'] . "', '" . $data['precio'] . "'";
    
                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL InsertDetallePedido($formattedStr);");
    
                return $result;


            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
    
            }
        }

        // Metodo para obtener los pedidos de un usuario
        public static function getOrdersByUserId($data) {
            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['idUsuario'] . "'";
    
                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL GetPedidosByUsuarioID($formattedStr);");
    
                return $result;
    
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
    
            }
        }

    }

?>