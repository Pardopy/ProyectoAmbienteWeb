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

                // header('Location: ../html-kevin/usuario-creado.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para obtener un usuario por email
        public static function getUserByEmail($data) {
            try {
                
                // Llamar al metodo del modelo para obtener
                $response = usuarioModel::getUserByEmail($data);
                print_r($response);

                return $response;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para actualizar los credenciales de un usuario por id
        public static function updateUser($data) {
            try {
                
                // Llamar al metodo del modelo para actualizar
                $response = usuarioModel::updateUser($data);
                print_r($response);

                // header('Location: ../html-kevin/credenciales-actualizadas.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para añadir un perfil al usuario
        public static function addProfile($data) {
            try {
                
                // Llamar al metodo del modelo para insertar
                $response = usuarioModel::addProfile($data);
                print_r($response);

                // header('Location: ../html-kevin/perfil-creado.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para obtener un perfil por id de usuario
        public static function getProfileByUserId($data) {
            try {
                
                // Llamar al metodo del modelo para obtener
                $response = usuarioModel::getProfileByUserId($data);
                // print_r($response);

                return $response;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para actualizar un perfil por id de usuario
        public static function updateProfile($data) {
            try {
                
                // Llamar al metodo del modelo para actualizar
                $response = usuarioModel::updateProfile($data);
                print_r($response);

                // header('Location: ../html-kevin/perfil-actualizado.html');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>