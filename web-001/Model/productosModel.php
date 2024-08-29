<?php
    // Imports
    // require_once('../Model/connModel.php');
    require_once(__DIR__ . '/connModel.php');

    class productosModel {
        // Metodo para obtener todos los productos
        public static function getAllProducts() {
            try {
                return connModel::fetchData("CALL GetAllProductos");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>