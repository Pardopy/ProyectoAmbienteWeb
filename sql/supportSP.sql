--Nuevo ticket de soporte
DELIMITER //
CREATE PROCEDURE InsertSoporteAyuda(
    IN p_usuario_id INT,
    IN p_asunto VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_estado_ticket ENUM('Abierto', 'En progreso', 'Cerrado')
)
BEGIN
    INSERT INTO Soporte_Ayuda (usuario_id, asunto, descripcion, estado_ticket)
    VALUES (p_usuario_id, p_asunto, p_descripcion, p_estado_ticket);
END //
DELIMITER ;

-- Obtener un ticket por ID
DELIMITER //
CREATE PROCEDURE GetSoporteAyudaByID(
    IN p_ticket_id INT
)
BEGIN
    SELECT * FROM Soporte_Ayuda WHERE ticket_id = p_ticket_id;
END //
DELIMITER ;

-- Obtener todos los tickets de soporte
DELIMITER //
CREATE PROCEDURE GetAllSoporteAyuda()
BEGIN
    SELECT * FROM Soporte_Ayuda;
END //
DELIMITER ;

-- Actualizar un ticket de soporte
DELIMITER //
CREATE PROCEDURE UpdateSoporteAyuda(
    IN p_ticket_id INT,
    IN p_usuario_id INT,
    IN p_asunto VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_estado_ticket ENUM('Abierto', 'En progreso', 'Cerrado')
)
BEGIN
    UPDATE Soporte_Ayuda
    SET usuario_id = p_usuario_id,
        asunto = p_asunto,
        descripcion = p_descripcion,
        estado_ticket = p_estado_ticket
    WHERE ticket_id = p_ticket_id;
END //
DELIMITER ;

-- Eliminar un ticket de soporte
DELIMITER //
CREATE PROCEDURE DeleteSoporteAyuda(
    IN p_ticket_id INT
)
BEGIN
    DELETE FROM Soporte_Ayuda WHERE ticket_id = p_ticket_id;
END //
DELIMITER ;
