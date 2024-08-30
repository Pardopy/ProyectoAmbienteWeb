<?php
    // Imports
    require_once(__DIR__ . '/../Model/usuarioModel.php');

    class usuarioController {

        // Metodo para insertar un nuevo usuario
        public static function addUser($data) {
            try {
                
                // Llamar al metodo del modelo para insertar
                $response = usuarioModel::addUser($data);
                print_r($response);

                header('Location: ../html-kevin/usuario-creado.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>