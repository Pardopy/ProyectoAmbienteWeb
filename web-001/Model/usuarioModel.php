<?php
    // Imports
    require_once(__DIR__ . '/connModel.php');

    class usuarioModel {
        // Metodo para insertar un nuevo usuario
        public static function addUser($data) {

            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['email'] . "', '" . $data['password'] . 
                "', '" . $data['tipoUsuario'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL InsertUsuario($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

            }

        }

        // Metodo para obtener un usuario por email
        public static function getUserByEmail($data) {

            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['email'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL GetUsuarioByCorreo($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

            }

        }

        // Metodo para añadir un perfil al usuario
        public static function addProfile($data) {

            try {
                // Verificar si el perfil incluye la foto de perfil
                if (isset($data['fotoPerfil'])) {
                    // Formatted string para la consulta
                    $formattedStr = "'" . $data['idUsuario'] . "', '" . $data['nombre'] . 
                    "', '" . $data['telefono'] . "', '" .$data['campoAdicional'] . 
                    "', '" . $data['biografia'] . "', '" . $data['fotoPerfil'] . "'";
                } else {
                    // Formatted string para la consulta sin foto de perfil
                    $formattedStr = "'" . $data['idUsuario'] . "', '" . $data['nombre'] . 
                    "', '" . $data['telefono'] . "', '" .$data['campoAdicional'] . 
                    "', '" . $data['biografia'] . "', NULL";
                }

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL InsertPerfil($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

            }

        }

    }

?>