-- Insertar un nuevo usuario
DELIMITER //
CREATE PROCEDURE InsertUsuario(
    IN p_nombre_completo VARCHAR(255),
    IN p_correo_electronico VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipo_usuario ENUM('Comprador', 'Agricultor')
)
BEGIN
    INSERT INTO Usuarios (nombre_completo, correo_electronico, contraseña, tipo_usuario)
    VALUES (p_nombre_completo, p_correo_electronico, p_contraseña, p_tipo_usuario);
END //
DELIMITER ;

-- Obtener un usuario por ID
DELIMITER //
CREATE PROCEDURE GetUsuarioByID(
    IN p_usuario_id INT
)
BEGIN
    SELECT * FROM Usuarios WHERE usuario_id = p_usuario_id;
END //
DELIMITER ;

-- Obtener todos los usuarios
DELIMITER //
CREATE PROCEDURE GetAllUsuarios()
BEGIN
    SELECT * FROM Usuarios;
END //
DELIMITER ;

-- Actualizar un usuario
DELIMITER //
CREATE PROCEDURE UpdateUsuario(
    IN p_usuario_id INT,
    IN p_nombre_completo VARCHAR(255),
    IN p_correo_electronico VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipo_usuario ENUM('Comprador', 'Agricultor')
)
BEGIN
    UPDATE Usuarios
    SET nombre_completo = p_nombre_completo,
        correo_electronico = p_correo_electronico,
        contraseña = p_contraseña,
        tipo_usuario = p_tipo_usuario
    WHERE usuario_id = p_usuario_id;
END //
DELIMITER ;

-- Eliminar un usuario
DELIMITER //
CREATE PROCEDURE DeleteUsuario(
    IN p_usuario_id INT
)
BEGIN
    DELETE FROM Usuarios WHERE usuario_id = p_usuario_id;
END //
DELIMITER ;

-- SPs para la nueva tabla de Usuarios
-- Insertar un nuevo usuario
DELIMITER //
CREATE PROCEDURE InsertUsuario(
    IN p_correo_electronico VARCHAR(255),
    IN p_contraseña VARCHAR(255),
    IN p_tipo_usuario ENUM('Comprador', 'Agricultor')
)
BEGIN
    INSERT INTO Usuarios (correo_electronico, contraseña, tipo_usuario)
    VALUES (p_correo_electronico, p_contraseña, p_tipo_usuario);
END //
DELIMITER ;

-- Obtener un usuario por correo electrónico
DELIMITER //
CREATE PROCEDURE GetUsuarioByCorreo(
    IN p_correo_electronico VARCHAR(255)
)
BEGIN
    SELECT * FROM Usuarios WHERE correo_electronico = p_correo_electronico;
END //
DELIMITER ;

-- Validar un usuario por correo electrónico y contraseña
DELIMITER //
CREATE PROCEDURE ValidateUsuario(
    IN p_correo_electronico VARCHAR(255),
    IN p_contraseña VARCHAR(255)
)
BEGIN
    SELECT * FROM Usuarios WHERE correo_electronico = p_correo_electronico AND contraseña = p_contraseña;
END //
DELIMITER ;
