-- Inserts para Categoria
INSERT INTO Categorias (nombre_categoria) VALUES ('Herramientas');
INSERT INTO Categorias (nombre_categoria) VALUES ('Fertilizantes');
INSERT INTO Categorias (nombre_categoria) VALUES ('Semillas');

-- Inserts para Productos
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Martillo', 'Martillo de 16 oz', 15.99, 100, 'https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0', 1);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Pala', 'Pala de punta redonda', 20.99, 50, 'https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0', 1);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Fertilizante 10-10-10', 'Fertilizante de liberación lenta', 10.99, 200, 'https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0', 2);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Semillas de Tomate', 'Semillas de tomate orgánicas', 5.99, 500, 'https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0', 3);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Semillas de Pimiento', 'Semillas de pimiento orgánicas', 5.99, 500, 'https://th.bing.com/th/id/R.5eac731c2d8395d387a6ef3b341f95d4?rik=0ZGE32BAzcKYhQ&riu=http%3a%2f%2fiaas.or.id%2fwp-content%2fuploads%2f2020%2f11%2f1_fJKDHgHkGdMZD_9tzMkjKw-1024x604.jpeg&ehk=X9RN%2fUrA3%2b5J8q%2fMMFyLH%2feQbLechXBAbz9axCXm3bU%3d&risl=&pid=ImgRaw&r=0', 3);

CREATE TABLE Foros (
    foro_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Inserts para foros
INSERT INTO Foros (usuario_id, titulo, descripcion) VALUES (1, 'Jardinería', 'Les cuento mi experiencia con la jardinería');