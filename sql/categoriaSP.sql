-- Insertar una nueva categoría
DELIMITER //
CREATE PROCEDURE InsertCategoria(
    IN p_nombre_categoria VARCHAR(255)
)
BEGIN
    INSERT INTO Categorias (nombre_categoria) VALUES (p_nombre_categoria);
END //
DELIMITER ;

-- Obtener una categoría por ID
DELIMITER //
CREATE PROCEDURE GetCategoriaByID(
    IN p_categoria_id INT
)
BEGIN
    SELECT * FROM Categorias WHERE categoria_id = p_categoria_id;
END //
DELIMITER ;

-- Obtener todas las categorías
DELIMITER //
CREATE PROCEDURE GetAllCategorias()
BEGIN
    SELECT * FROM Categorias;
END //
DELIMITER ;

-- Actualizar una categoría
DELIMITER //
CREATE PROCEDURE UpdateCategoria(
    IN p_categoria_id INT,
    IN p_nombre_categoria VARCHAR(255)
)
BEGIN
    UPDATE Categorias
    SET nombre_categoria = p_nombre_categoria
    WHERE categoria_id = p_categoria_id;
END //
DELIMITER ;

-- Eliminar una categoría
DELIMITER //
CREATE PROCEDURE DeleteCategoria(
    IN p_categoria_id INT
)
BEGIN
    DELETE FROM Categorias WHERE categoria_id = p_categoria_id;
END //
DELIMITER ;
