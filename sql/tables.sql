CREATE DATABASE agroconnect;
USE agroconnect;

CREATE TABLE Usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    correo_electronico VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('Comprador', 'Agricultor') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Perfiles (
    perfil_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(12),
    campo_adicional VARCHAR(255),
    biografia TEXT,
    foto_perfil VARCHAR(1024),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

CREATE TABLE Categorias (
    categoria_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(255) NOT NULL
);

CREATE TABLE Productos (
    producto_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad_disponible INT NOT NULL,
    imagen_producto VARCHAR(1024),
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES Categorias(categoria_id)
);

CREATE TABLE Calidad_Certificaciones (
    certificacion_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_certificacion VARCHAR(255) NOT NULL,
    descripcion TEXT
);

CREATE TABLE Producto_Certificaciones (
    producto_certificacion_id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    certificacion_id INT NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id),
    FOREIGN KEY (certificacion_id) REFERENCES Calidad_Certificaciones(certificacion_id)
);

CREATE TABLE Pedidos (
    pedido_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado_pedido ENUM('Pendiente', 'Enviado', 'Entregado', 'Cancelado') NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

CREATE TABLE Detalles_Pedido (
    detalle_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id),
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);

CREATE TABLE Foros (
    foro_id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Comentarios_Foros (
    comentario_id INT AUTO_INCREMENT PRIMARY KEY,
    foro_id INT NOT NULL,
    usuario_id INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_comentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (foro_id) REFERENCES Foros(foro_id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

CREATE TABLE Soporte_Ayuda (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    estado_ticket ENUM('Abierto', 'En progreso', 'Cerrado') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

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

CREATE TABLE Recursos_Herramientas (
    recurso_id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    enlace VARCHAR(255)
);


USE agroconnect;

-- Eliminar la tabla de producto_certificaciones
DROP TABLE IF EXISTS Producto_Certificaciones;

-- Eliminar la tabla de recursos
DROP TABLE IF EXISTS Recursos_Herramientas;

-- Eliminar la tabla de perfiles
DROP TABLE IF EXISTS Perfiles;
USE agroconnect;

SHOW TABLES;