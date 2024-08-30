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

    }

?>