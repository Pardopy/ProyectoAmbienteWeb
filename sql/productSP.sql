-- Insertar un nuevo producto
DELIMITER //
CREATE PROCEDURE InsertProducto(
    IN p_nombre_producto VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10, 2),
    IN p_cantidad_disponible INT,
    IN p_imagen_producto VARCHAR(255),
    IN p_categoria_id INT
)
BEGIN
    INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id)
    VALUES (p_nombre_producto, p_descripcion, p_precio, p_cantidad_disponible, p_imagen_producto, p_categoria_id);
END //
DELIMITER ;

-- Obtener un producto por ID
DELIMITER //
CREATE PROCEDURE GetProductoByID(
    IN p_producto_id INT
)
BEGIN
    SELECT * FROM Productos WHERE producto_id = p_producto_id;
END //
DELIMITER ;

-- Obtener todos los productos
DELIMITER //
CREATE PROCEDURE GetAllProductos()
BEGIN
    SELECT * FROM Productos;
END //
DELIMITER ;

-- Actualizar un producto
DELIMITER //
CREATE PROCEDURE UpdateProducto(
    IN p_producto_id INT,
    IN p_nombre_producto VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10, 2),
    IN p_cantidad_disponible INT,
    IN p_imagen_producto VARCHAR(255),
    IN p_categoria_id INT
)
BEGIN
    UPDATE Productos
    SET nombre_producto = p_nombre_producto,
        descripcion = p_descripcion,
        precio = p_precio,
        cantidad_disponible = p_cantidad_disponible,
        imagen_producto = p_imagen_producto,
        categoria_id = p_categoria_id
    WHERE producto_id = p_producto_id;
END //
DELIMITER ;

-- Eliminar un producto
DELIMITER //
CREATE PROCEDURE DeleteProducto(
    IN p_producto_id INT
)
BEGIN
    DELETE FROM Productos WHERE producto_id = p_producto_id;
END //
DELIMITER ;

-- Obtener productos por categoria
DELIMITER //
CREATE PROCEDURE GetProductosByCategoria(
    IN p_categoria_id INT
)
BEGIN
    SELECT * FROM Productos WHERE categoria_id = p_categoria_id;
END //

-- Obtener productos por nombre
DELIMITER //
CREATE PROCEDURE GetProductosByNombre(
    IN p_nombre_producto VARCHAR(255)
)
BEGIN
    SELECT * FROM Productos WHERE nombre_producto LIKE CONCAT('%', p_nombre_producto, '%');
END //

-- Obtener productos por categoria y nombre
DELIMITER //
CREATE PROCEDURE GetProductosByCategoriaAndNombre(
    IN p_categoria_id INT,
    IN p_nombre_producto VARCHAR(255)
)
BEGIN
    SELECT * FROM Productos WHERE categoria_id = p_categoria_id AND nombre_producto LIKE CONCAT('%', p_nombre_producto, '%');
END //