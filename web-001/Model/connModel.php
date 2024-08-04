<?php

class connModel {
    
    // Conexion con DB
    private static function connect() {

        try {
            
            $conn = mysqli_connect(
                '#', // Host: localhost
                '#', // Usuario: root
                '#', // Contraseña: root
                '#', // DB: awcs_proyecto
            );

            return $conn;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    // Desconexion con DB
    private static function disconnect($conn, $result) {

        try {
            
            mysqli_close($conn);
            mysqli_free_result($result);

            // if ($result instanceof mysqli_result) {
            //     mysqli_free_result($result);
            // }
            // mysqli_close($conn);

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    // Metodo para ejecutar consultas SQL
    public static function executeQuery($query) {

        $conn = self::connect();

        try {
            
            $result = mysqli_query($conn, $query);

            $sqlOutput = array(
                'success' => $result,
                'error' => mysqli_error($conn),
                'conn' => $conn
            );

            return $sqlOutput;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    // Metodo para extraer los datos de la consulta SQL realizada
    public static function fetchData($query) {

        try {
            
            $sqlOutput = self::executeQuery($query);

            $rows = array();

            if ($sqlOutput['success']) {

                while ($row = mysqli_fetch_array($sqlOutput['success'], MYSQLI_ASSOC)) {

                    $rows[] = $row;

                }

                self::disconnect($sqlOutput['conn'], $sqlOutput);

                return $rows;

            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }


}

?>