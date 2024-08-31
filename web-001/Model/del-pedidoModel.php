<?php
// Incluir el archivo connModel.php
include_once 'connModel.php';

// Script del PEDIDO 
function insertarPedido($usuario_id, $estado_pedido) {
    global $conn;
    $sql = "INSERT INTO Pedidos (usuario_id, estado_pedido) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $usuario_id, $estado_pedido);
    return $stmt->execute();
}


function actualizarPedido($pedido_id, $estado_pedido) {
    global $conn;
    $sql = "UPDATE Pedidos SET estado_pedido = ? WHERE pedido_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $estado_pedido, $pedido_id);
    return $stmt->execute();
}

function eliminarPedido($pedido_id) {
    global $conn;
    $sql = "DELETE FROM Pedidos WHERE pedido_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    return $stmt->execute();
}

function obtenerPedidoPorId($pedido_id) {
    global $conn;
    $sql = "SELECT * FROM Pedidos WHERE pedido_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pedido_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function obtenerTodosLosPedidos() {
    global $conn;
    $sql = "SELECT * FROM Pedidos";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

?>
