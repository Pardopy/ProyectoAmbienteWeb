<?php
    // Imports
    require_once(__DIR__ . '/../Model/categoriaModel.php');

    class categoriaController {
        // Metodo para obtener todas las categorias
        public static function getAllCategories() {
            try {
                return categoriaModel::getAllCategories();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>