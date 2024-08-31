-- Insertar nuevo foro
DELIMITER //
CREATE PROCEDURE InsertForo(
    IN p_titulo VARCHAR(255),
    IN p_descripcion TEXT
)
BEGIN
    INSERT INTO Foros (titulo, descripcion)
    VALUES (p_titulo, p_descripcion);
END //
DELIMITER ;

-- Obtener un foro por ID
DELIMITER //
CREATE PROCEDURE GetForoByID(
    IN p_foro_id INT
)
BEGIN
    SELECT * FROM Foros WHERE foro_id = p_foro_id;
END //
DELIMITER ;

-- Obtener todos los foros
DELIMITER //
CREATE PROCEDURE GetAllForos()
BEGIN
    SELECT * FROM Foros;
END //
DELIMITER ;

-- Actualizar un foro
DELIMITER //
CREATE PROCEDURE UpdateForo(
    IN p_foro_id INT,
    IN p_titulo VARCHAR(255),
    IN p_descripcion TEXT
)
BEGIN
    UPDATE Foros
    SET titulo = p_titulo,
        descripcion = p_descripcion
    WHERE foro_id = p_foro_id;
END //
DELIMITER ;

-- Eliminar un foro
DELIMITER //
CREATE PROCEDURE DeleteForo(
    IN p_foro_id INT
)
BEGIN
    DELETE FROM Foros WHERE foro_id = p_foro_id;
END //
DELIMITER ;

-- Insertar un nuevo comentario en el foro
DELIMITER //
CREATE PROCEDURE InsertComentarioForo(
    IN p_foro_id INT,
    IN p_usuario_id INT,
    IN p_contenido TEXT
)
BEGIN
    INSERT INTO Comentarios_Foros (foro_id, usuario_id, contenido)
    VALUES (p_foro_id, p_usuario_id, p_contenido);
END //
DELIMITER ;

-- Obtener un comentario por ID
DELIMITER //
CREATE PROCEDURE GetComentarioForoByID(
    IN p_comentario_id INT
)
BEGIN
    SELECT * FROM Comentarios_Foros WHERE comentario_id = p_comentario_id;
END //
DELIMITER ;

-- Obtener todos los comentarios
DELIMITER //
CREATE PROCEDURE GetAllComentariosForo()
BEGIN
    SELECT * FROM Comentarios_Foros;
END //
DELIMITER ;

-- Actualizar un comentario
DELIMITER //
CREATE PROCEDURE UpdateComentarioForo(
    IN p_comentario_id INT,
    IN p_contenido TEXT
)
BEGIN
    UPDATE Comentarios_Foros
    SET contenido = p_contenido
    WHERE comentario_id = p_comentario_id;
END //
DELIMITER ;

-- Eliminar un comentario
DELIMITER //
CREATE PROCEDURE DeleteComentarioForo(
    IN p_comentario_id INT
)
BEGIN
    DELETE FROM Comentarios_Foros WHERE comentario_id = p_comentario_id;
END //
DELIMITER ;


-- Nuevo insertar foro
DELIMITER //
CREATE PROCEDURE InsertForo(
    IN p_usuario_id INT,
    IN p_titulo VARCHAR(255),
    IN p_descripcion TEXT
)
BEGIN
    INSERT INTO Foros (usuario_id, titulo, descripcion)
    VALUES (p_usuario_id, p_titulo, p_descripcion);
END //