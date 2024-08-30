-- Insertar un nuevo perfil
DELIMITER //
CREATE PROCEDURE InsertPerfil(
    IN p_usuario_id INT,
    IN p_nombre_completo VARCHAR(255),
    IN p_telefono VARCHAR(12),
    IN p_campo_adicional VARCHAR(255),
    IN p_biografia TEXT,
    IN p_foto_perfil VARCHAR(1024)
)
BEGIN
    IF p_foto_perfil IS NULL THEN
        INSERT INTO Perfiles (usuario_id, nombre_completo, telefono, campo_adicional, biografia)
        VALUES (p_usuario_id, p_nombre_completo, p_telefono, p_campo_adicional, p_biografia);
    ELSE
        INSERT INTO Perfiles (usuario_id, nombre_completo, telefono, campo_adicional, biografia, foto_perfil)
        VALUES (p_usuario_id, p_nombre_completo, p_telefono, p_campo_adicional, p_biografia, p_foto_perfil);
    END IF;
END //

-- Actualizar un perfil por ID de usuario
DELIMITER //
CREATE PROCEDURE UpdatePerfil(
    IN p_usuario_id INT,
    IN p_nombre_completo VARCHAR(255),
    IN p_telefono VARCHAR(12),
    IN p_campo_adicional VARCHAR(255),
    IN p_biografia TEXT,
    IN p_foto_perfil VARCHAR(1024)
)
BEGIN
    IF p_foto_perfil IS NULL THEN
        UPDATE Perfiles
        SET nombre_completo = p_nombre_completo,
            telefono = p_telefono,
            campo_adicional = p_campo_adicional,
            biografia = p_biografia
        WHERE usuario_id = p_usuario_id;
    ELSE
        UPDATE Perfiles
        SET nombre_completo = p_nombre_completo,
            telefono = p_telefono,
            campo_adicional = p_campo_adicional,
            biografia = p_biografia,
            foto_perfil = p_foto_perfil
        WHERE usuario_id = p_usuario_id;
    END IF;
END //

-- Obtener un perfil por ID de usuario
DELIMITER //
CREATE PROCEDURE GetPerfilByUsuarioID(
    IN p_usuario_id INT
)
BEGIN
    SELECT * FROM Perfiles WHERE usuario_id = p_usuario_id;
END //
