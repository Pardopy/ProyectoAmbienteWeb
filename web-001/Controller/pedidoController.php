<?php
    // Imports
    require_once(__DIR__ . '/../Model/pedidoModel.php');

    class pedidoController {
        // Metodo para insertar un nuevo pedido
        public static function addOrder($data) {
            try {
                
                // Llamar al metodo del modelo para insertar
                $response = pedidoModel::addOrder($data);
                // print_r($response);

                // header('Location: ../html-kevin/pedido-enviado.html');

                return $response;
                
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para insertar detalles de un pedido
        public static function addOrderDetails($data) {
            try {
                
                // Llamar al metodo del modelo para insertar
                $response = pedidoModel::addOrderDetails($data);
                // print_r($response);

                // header('Location: ../html-kevin/pedido-enviado.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para obtener los pedidos de un usuario
        public static function getOrdersByUserId($data) {
            try {
                
                // Llamar al metodo del modelo para obtener
                $response = pedidoModel::getOrdersByUserId($data);
                // print_r($response);

                return $response;
                
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para obtener los pedidos de un usuario
        public static function getOrderDetails($data) {
            try {
                
                // Llamar al metodo del modelo para obtener
                $response = pedidoModel::getOrderDetails($data);
                // print_r($response);

                return $response;
                
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>