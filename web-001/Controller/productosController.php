<?php
    // Imports
    // require_once('C:/Users/fanta/OneDrive/Documents/GitHub Workplaces/ProyectoAmbienteWeb/web-001/Model/productosModel.php');
    require_once(__DIR__ . '/../Model/productosModel.php');

    
    class productosController {
        //Metodo para obtener todos los productos
        public static function getAllProducts() {

            try {
                return productosModel::getAllProducts();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        //Metodo para buscar los productos por categoria
        public static function getProductsByCategory($data) {

            try {

                // Se llama al metodo del modelo para obtener los productos por categoria
                $result = productosModel::getProductsByCategory($data);
                print_r($result);
                // header('Location: ../html-kevin/productos.php');
                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        // Metodo para buscar los productos por nombre
        public static function getProductsByName($data) {

            try {

                // Se llama al metodo del modelo para obtener los productos por nombre
                $result = productosModel::getProductsByName($data);
                print_r($result);
                // header('Location: ../html-kevin/productos.php');
                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        // Metodo para buscar los productos por nombre y categoria
        public static function getProductsByCategoryAndName($data) {

            try {

                // Se llama al metodo del modelo para obtener los productos por nombre y categoria
                $result = productosModel::getProductsByCategoryAndName($data);
                print_r($result);
                // header('Location: ../html-kevin/productos.php');
                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

    }

?>