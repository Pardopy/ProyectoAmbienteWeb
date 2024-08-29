<?php
// Incluir el archivo connModel.php
include_once 'connModel.php';

//SCRIPT del Foro
function insertarForo($titulo, $descripcion) {
    global $conn;
    $sql = "INSERT INTO Foros (titulo, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $titulo, $descripcion);
    return $stmt->execute();
}

function actualizarForo($foro_id, $titulo, $descripcion) {
    global $conn;
    $sql = "UPDATE Foros SET titulo = ?, descripcion = ? WHERE foro_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $titulo, $descripcion, $foro_id);
    return $stmt->execute();
}

function eliminarForo($foro_id) {
    global $conn;
    $sql = "DELETE FROM Foros WHERE foro_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $foro_id);
    return $stmt->execute();
}

function obtenerForoPorId($foro_id) {
    global $conn;
    $sql = "SELECT * FROM Foros WHERE foro_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $foro_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodosLosForos() {
    global $conn;
    $sql = "SELECT * FROM Foros";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
