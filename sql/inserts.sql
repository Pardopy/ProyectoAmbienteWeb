-- Inserts para Categoria
INSERT INTO Categorias (nombre_categoria) VALUES ('Herramientas');
INSERT INTO Categorias (nombre_categoria) VALUES ('Fertilizantes');
INSERT INTO Categorias (nombre_categoria) VALUES ('Semillas');

-- Inserts para Productos
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Martillo', 'Martillo de 16 oz', 15.99, 100, 'martillo.jpg', 1);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Pala', 'Pala de punta redonda', 20.99, 50, 'pala.jpg', 1);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Fertilizante 10-10-10', 'Fertilizante de liberación lenta', 10.99, 200, 'fertilizante.jpg', 2);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Semillas de Tomate', 'Semillas de tomate orgánicas', 5.99, 500, 'tomate.jpg', 3);
INSERT INTO Productos (nombre_producto, descripcion, precio, cantidad_disponible, imagen_producto, categoria_id) VALUES ('Semillas de Pimiento', 'Semillas de pimiento orgánicas', 5.99, 500, 'pimiento.jpg', 3);
