<?php
// Incluir el archivo connModel.php
include_once 'connModel.php';

//Script de los Productos

function insertarProducto($nombre_producto, $descripcion, $precio, $cantidad_disponible, $imagen_producto, $categoria_id) {
    global $conn;
    $sql = "INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisi", $nombre_producto, $descripcion, $precio, $cantidad_disponible, $imagen_producto, $categoria_id);
    return $stmt->execute();
}

function actualizarProducto($producto_id, $nombre_producto, $descripcion, $precio, $cantidad_disponible, $imagen_producto, $categoria_id) {
    global $conn;
    $sql = "UPDATE Productos SET nombre_producto = ?, descripcion = ?, precio = ?, cantidad_disponible = ?, imagen_producto = ?, categoria_id = ? WHERE producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdisii", $nombre_producto, $descripcion, $precio, $cantidad_disponible, $imagen_producto, $categoria_id, $producto_id);
    return $stmt->execute();
}


function eliminarProducto($producto_id) {
    global $conn;
    $sql = "DELETE FROM Productos WHERE producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    return $stmt->execute();
}


function obtenerProductoPorId($producto_id) {
    global $conn;
    $sql = "SELECT * FROM Productos WHERE producto_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodosLosProductos() {
    global $conn;
    $sql = "SELECT * FROM Productos";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}


?>
