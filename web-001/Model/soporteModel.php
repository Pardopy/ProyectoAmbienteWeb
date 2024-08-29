<?php
    // Imports
    require_once(__DIR__ . '/connModel.php');

    class soporteModel {
        // Metodo para insertar un nuevo ticket de soporte
        public static function addSupportTicket($data) {

            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['nombre'] . "', '" . $data['apellido'] . "', '" . $data['correo'] . 
                "', '" . $data['telefono'] . "', '" . $data['tema'] . "', '" . $data['mensaje'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL InsertSoporte($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

            }

        }

    }

?>