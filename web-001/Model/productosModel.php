<?php
    // Imports
    // require_once('../Model/connModel.php');
    require_once(__DIR__ . '/connModel.php');

    class productosModel {
        // Metodo para obtener todos los productos
        public static function getAllProducts() {
            try {
                return connModel::fetchData("CALL GetAllProductos();");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para buscar los productos por categoria
        public static function getProductsByCategory($data) {
            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['categoria_id'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL GetProductosByCategoria($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para buscar los productos por nombre
        public static function getProductsByName($data) {
            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['keyword'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL GetProductosByNombre($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>