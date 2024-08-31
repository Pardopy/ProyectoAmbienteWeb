<?php
    // Imports
    require_once(__DIR__ . '/../Model/soporteModel.php');

    class soporteController {

        // Metodo para insertar un nuevo ticket de soporte
        public static function addSupportTicket($data) {
            try {
                
                // Llamar al metodo del modelo para insertar
                $response = soporteModel::addSupportTicket($data);
                print_r($response);

                header('Location: ../html-kevin/soporte-enviado.php');

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

?>