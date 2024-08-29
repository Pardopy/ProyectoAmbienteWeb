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

    }

?>