<?php
// Incluir el archivo connModel.php
include_once 'connModel.php';

// Script de Categorias

function insertarCategoria($nombre_categoria) {
    global $conn;
    $sql = "INSERT INTO Categorias (nombre_categoria) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_categoria);
    return $stmt->execute();
}

function actualizarCategoria($categoria_id, $nombre_categoria) {
    global $conn;
    $sql = "UPDATE Categorias SET nombre_categoria = ? WHERE categoria_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nombre_categoria, $categoria_id);
    return $stmt->execute();
}

function eliminarCategoria($categoria_id) {
    global $conn;
    $sql = "DELETE FROM Categorias WHERE categoria_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    return $stmt->execute();
}

function obtenerCategoriaPorId($categoria_id) {
    global $conn;
    $sql = "SELECT * FROM Categorias WHERE categoria_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoria_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodasLasCategorias() {
    global $conn;
    $sql = "SELECT * FROM Categorias";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
