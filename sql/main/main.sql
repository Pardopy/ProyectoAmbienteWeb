-- SPs de Productos
-- Obtener todos los productos
DELIMITER //
CREATE PROCEDURE GetAllProductos()
BEGIN
    SELECT * FROM Productos;
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

-- SPs de Categorias
-- Obtener todas las categorías
DELIMITER //
CREATE PROCEDURE GetAllCategorias()
BEGIN
    SELECT * FROM Categorias;
END //
DELIMITER ;

-- SPs de Soporte
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

-- SPs de Usuarios
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

-- SPs de Perfiles
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
