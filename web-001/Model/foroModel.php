<?php
    // Imports
    // require_once('../Model/connModel.php');
    require_once(__DIR__ . '/connModel.php');

    class foroModel {
        // Metodo para obtener todos los foros
        public static function getAllForos() {
            try {
                return connModel::fetchData("CALL GetAllForos();");
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        // Metodo para insertar un nuevo foro
        public static function insertForo($data) {
            try {
                // Formatted string para la consulta
                $formattedStr = "'" . $data['idUsuario'] . "', '" . $data['titulo'] . "', '" . $data['descripcion'] . "'";

                // Ejecutar la consulta y guardar el resultado
                $result = connModel::fetchData("CALL InsertForo($formattedStr);");

                return $result;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>