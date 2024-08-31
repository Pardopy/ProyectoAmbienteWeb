-- Insertar nuevo pedido
DELIMITER //
CREATE PROCEDURE InsertPedido(
    IN p_usuario_id INT,
    IN p_estado_pedido ENUM('Pendiente', 'Enviado', 'Entregado', 'Cancelado')
)
BEGIN
    INSERT INTO Pedidos (usuario_id, estado_pedido)
    VALUES (p_usuario_id, p_estado_pedido);
END //
DELIMITER ;

-- Obtener un pedido por ID
DELIMITER //
CREATE PROCEDURE GetPedidoByID(
    IN p_pedido_id INT
)
BEGIN
    SELECT * FROM Pedidos WHERE pedido_id = p_pedido_id;
END //
DELIMITER ;

-- Obtener todos los pedidos
DELIMITER //
CREATE PROCEDURE GetAllPedidos()
BEGIN
    SELECT * FROM Pedidos;
END //
DELIMITER ;

-- Actualizar un pedido
DELIMITER //
CREATE PROCEDURE UpdatePedido(
    IN p_pedido_id INT,
    IN p_usuario_id INT,
    IN p_estado_pedido ENUM('Pendiente', 'Enviado', 'Entregado', 'Cancelado')
)
BEGIN
    UPDATE Pedidos
    SET usuario_id = p_usuario_id,
        estado_pedido = p_estado_pedido
    WHERE pedido_id = p_pedido_id;
END //
DELIMITER ;

-- Eliminar un pedido
DELIMITER //
CREATE PROCEDURE DeletePedido(
    IN p_pedido_id INT
)
BEGIN
    DELETE FROM Pedidos WHERE pedido_id = p_pedido_id;
END //
DELIMITER ;

-- Insertar un nuevo detalle de pedido
DELIMITER //
CREATE PROCEDURE InsertDetallePedido(
    IN p_pedido_id INT,
    IN p_producto_id INT,
    IN p_cantidad INT,
    IN p_precio_unitario DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, precio_unitario)
    VALUES (p_pedido_id, p_producto_id, p_cantidad, p_precio_unitario);
END //
DELIMITER ;

-- Obtener un detalle de pedido por ID
DELIMITER //
CREATE PROCEDURE GetDetallePedidoByID(
    IN p_detalle_id INT
)
BEGIN
    SELECT * FROM Detalles_Pedido WHERE detalle_id = p_detalle_id;
END //
DELIMITER ;

-- Obtener todos los detalles de pedido
DELIMITER //
CREATE PROCEDURE GetAllDetallesPedido()
BEGIN
    SELECT * FROM Detalles_Pedido;
END //
DELIMITER ;

-- Actualizar un detalle de pedido
DELIMITER //
CREATE PROCEDURE UpdateDetallePedido(
    IN p_detalle_id INT,
    IN p_pedido_id INT,
    IN p_producto_id INT,
    IN p_cantidad INT,
    IN p_precio_unitario DECIMAL(10, 2)
)
BEGIN
    UPDATE Detalles_Pedido
    SET pedido_id = p_pedido_id,
        producto_id = p_producto_id,
        cantidad = p_cantidad,
        precio_unitario = p_precio_unitario
    WHERE detalle_id = p_detalle_id;
END //
DELIMITER ;

-- Eliminar un detalle de pedido
DELIMITER //
CREATE PROCEDURE DeleteDetallePedido(
    IN p_detalle_id INT
)
BEGIN
    DELETE FROM Detalles_Pedido WHERE detalle_id = p_detalle_id;
END //
DELIMITER ;

-- Insertar un nuevo pedido y retornar el ID
DELIMITER //
CREATE PROCEDURE InsertPedidoAndReturn(
    IN p_usuario_id INT,
    IN p_estado_pedido ENUM('Pendiente', 'Enviado', 'Entregado', 'Cancelado')
)
BEGIN
    INSERT INTO Pedidos (usuario_id, estado_pedido)
    VALUES (p_usuario_id, p_estado_pedido);
    SELECT * FROM Pedidos WHERE pedido_id = LAST_INSERT_ID();
END //

-- Insertar un nuevo detalle de pedido
DELIMITER //
CREATE PROCEDURE InsertDetallePedido(
    IN p_pedido_id INT,
    IN p_producto_id INT,
    IN p_cantidad INT,
    IN p_precio_unitario DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Detalles_Pedido (pedido_id, producto_id, cantidad, precio_unitario)
    VALUES (p_pedido_id, p_producto_id, p_cantidad, p_precio_unitario);
END //

-- Obtener los pedidos por ID de usuario
DELIMITER //
CREATE PROCEDURE GetPedidosByUsuarioID(
    IN p_usuario_id INT
)
BEGIN
    SELECT * FROM Pedidos WHERE usuario_id = p_usuario_id;
END //

-- Obtener los detalles de un pedido por ID de pedido
DELIMITER //
CREATE PROCEDURE GetDetallesPedidoByPedidoID(
    IN p_pedido_id INT
)
BEGIN
    SELECT * FROM Detalles_Pedido WHERE pedido_id = p_pedido_id;
END //
