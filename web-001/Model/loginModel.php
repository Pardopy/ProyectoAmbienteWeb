<?php
    // Imports
    require_once(__DIR__ . '/connModel.php');

    class loginModel {
        // Metodo para validar un usuario
        public static function validateUser($data) {

            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['email'] . "', '" . $data['password'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL ValidateUsuario($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

            }

        }
    }

?>