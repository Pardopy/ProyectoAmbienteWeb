<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // Servidor de la base de datos
$username = "root";         // Nombre de usuario
$password = "Motocros10";             // Contraseña (en blanco por defecto en XAMPP)
$dbname = "agroconnect";    // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos agroconnect";
?>
