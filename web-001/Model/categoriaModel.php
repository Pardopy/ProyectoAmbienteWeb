<?php
    // Imports
    require_once(__DIR__ . '/connModel.php');

    class categoriaModel {
        // Metodo para obtener todas las categorias
        public static function getAllCategories() {
            try {
                return connModel::fetchData("CALL GetAllCategorias();");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>
