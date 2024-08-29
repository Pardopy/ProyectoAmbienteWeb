<?php
// Incluir el archivo connModel.php
include_once 'connModel.php';

//SCRIPT de Support
function insertarTicketSoporte($usuario_id, $asunto, $descripcion, $estado_ticket) {
    global $conn;
    $sql = "INSERT INTO Soporte_Ayuda (usuario_id, asunto, descripcion, estado_ticket) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $usuario_id, $asunto, $descripcion, $estado_ticket);
    return $stmt->execute();
}

function actualizarTicketSoporte($ticket_id, $asunto, $descripcion, $estado_ticket) {
    global $conn;
    $sql = "UPDATE Soporte_Ayuda SET asunto = ?, descripcion = ?, estado_ticket = ? WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $asunto, $descripcion, $estado_ticket, $ticket_id);
    return $stmt->execute();
}

function eliminarTicketSoporte($ticket_id) {
    global $conn;
    $sql = "DELETE FROM Soporte_Ayuda WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    return $stmt->execute();
}


function obtenerTicketSoportePorId($ticket_id) {
    global $conn;
    $sql = "SELECT * FROM Soporte_Ayuda WHERE ticket_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodosLosTicketsSoporte() {
    global $conn;
    $sql = "SELECT * FROM Soporte_Ayuda";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
