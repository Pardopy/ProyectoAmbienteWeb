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
}


// Script de Usuarios
function insertarUsuario($nombre_completo, $correo_electronico, $contraseña, $tipo_usuario) {
    global $conn;
    $sql = "INSERT INTO Usuarios (nombre_completo, correo_electronico, contraseña, tipo_usuario) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre_completo, $correo_electronico, $contraseña, $tipo_usuario);
    return $stmt->execute();
}

function actualizarUsuario($usuario_id, $nombre_completo, $correo_electronico, $contraseña, $tipo_usuario) {
    global $conn;
    $sql = "UPDATE Usuarios SET nombre_completo = ?, correo_electronico = ?, contraseña = ?, tipo_usuario = ? WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre_completo, $correo_electronico, $contraseña, $tipo_usuario, $usuario_id);
    return $stmt->execute();
}

function eliminarUsuario($usuario_id) {
    global $conn;
    $sql = "DELETE FROM Usuarios WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    return $stmt->execute();
}

function obtenerUsuarioPorId($usuario_id) {
    global $conn;
    $sql = "SELECT * FROM Usuarios WHERE usuario_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodosLosUsuarios() {
    global $conn;
    $sql = "SELECT * FROM Usuarios";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
