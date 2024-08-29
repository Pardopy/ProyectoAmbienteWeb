<?php

class connModel {
    
    // Conexion con DB
    private static function connect() {

        try {
            
            $conn = mysqli_connect(
                'localhost', // Host: localhost
                'root', // Usuario: root
                'root', // Contraseña: root
                'agroconnect', // DB: awcs_proyecto
            );

            return $conn;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    // Desconexion con DB
    private static function disconnect($conn, $result) {

        try {
            
            // mysqli_close($conn);
            // mysqli_free_result($result);

            if ($result instanceof mysqli_result) {
                mysqli_free_result($result);
            }
            mysqli_close($conn);

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

                if (!is_bool($sqlOutput['success'])) {
                    while ($row = mysqli_fetch_assoc($sqlOutput['success'])) {
                        $rows[] = $row;
                    }
                }

                self::disconnect($sqlOutput['conn'], $sqlOutput);

                return $rows;

            } else {
                self::disconnect($sqlOutput['conn'], $sqlOutput['success']);

                echo "Error: " . $sqlOutput['error'];
                return $sqlOutput['error'];
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

}

?>