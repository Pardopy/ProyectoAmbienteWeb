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

CREATE TABLE Soporte (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono VARCHAR(12) NOT NULL,
    tema VARCHAR(50) NOT NULL,
    mensaje TEXT NOT NULL,
    estado_ticket ENUM('Abierto', 'En progreso', 'Cerrado') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- SPs para la nueva tabla de Soporte

-- Insertar un nuevo ticket de soporte
DELIMITER //
CREATE PROCEDURE InsertSoporte(
    IN p_nombre VARCHAR(255),
    IN p_apellido VARCHAR(255),
    IN p_correo VARCHAR(255),
    IN p_telefono VARCHAR(12),
    IN p_tema VARCHAR(50),
    IN p_mensaje TEXT
)
BEGIN
    INSERT INTO Soporte (nombre, apellido, correo, telefono, tema, mensaje, estado_ticket)
    VALUES (p_nombre, p_apellido, p_correo, p_telefono, p_tema, p_mensaje, 'Abierto');
END //
DELIMITER ;