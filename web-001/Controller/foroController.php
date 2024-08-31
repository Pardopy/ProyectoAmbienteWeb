<?php
    // Imports
    require_once(__DIR__ . '/../Model/foroModel.php');

    
    class foroController {

        // Metodo para obtener todos los foros
        public static function getAllForos() {

            try {
                return foroModel::getAllForos();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

        // Metodo para insertar un nuevo foro
        public static function insertForo($data) {

            try {

                // Se llama al metodo del modelo para insertar un nuevo foro
                $result = foroModel::insertForo($data);
                print_r($result);
                header('Location: ../html-heymmy/foro.php');
                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }

    }

?>