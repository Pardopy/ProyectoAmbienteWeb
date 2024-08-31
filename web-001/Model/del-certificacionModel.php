<?php

// Incluir el archivo connModel.php
include_once 'connModel.php';

// Script de las Certificaciones

function insertarCertificacion($nombre_certificacion, $descripcion) {
    global $conn;
    $sql = "INSERT INTO Calidad_Certificaciones (nombre_certificacion, descripcion) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nombre_certificacion, $descripcion);
    return $stmt->execute();
}

function actualizarCertificacion($certificacion_id, $nombre_certificacion, $descripcion) {
    global $conn;
    $sql = "UPDATE Calidad_Certificaciones SET nombre_certificacion = ?, descripcion = ? WHERE certificacion_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre_certificacion, $descripcion, $certificacion_id);
    return $stmt->execute();
}

function eliminarCertificacion($certificacion_id) {
    global $conn;
    $sql = "DELETE FROM Calidad_Certificaciones WHERE certificacion_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $certificacion_id);
    return $stmt->execute();
}

function obtenerCertificacionPorId($certificacion_id) {
    global $conn;
    $sql = "SELECT * FROM Calidad_Certificaciones WHERE certificacion_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $certificacion_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodasLasCertificaciones() {
    global $conn;
    $sql = "SELECT * FROM Calidad_Certificaciones";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
