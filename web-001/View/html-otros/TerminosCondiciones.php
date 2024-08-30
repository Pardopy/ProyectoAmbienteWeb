
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroConnect</title>
    <link rel="stylesheet" href="style.css"> <!-- Ensure the path to your CSS is correct -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="Index.php">Inicio</a></li>
                <li><a href="TerminosCondiciones.php">Términos y Condiciones</a></li>
                <li><a href="HerraBenAgri.php">Recursos para Agricultores</a></li>
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <li><a href="GestionPedidos.php">Gestión de Pedidos</a></li>
                    <li><a href="perfil.php">Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión (<?= $_SESSION['nombre_completo']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
<main>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Proyecto</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de que la ruta de la hoja de estilos sea correcta -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="Index.php">Inicio</a></li>
                <li><a href="TerminosCondiciones.php">Términos y Condiciones</a></li>
                <li><a href="HerraBenAgri.php">Recursos para Agricultores</a></li>
                <?php if(isset($_SESSION['usuario_id'])): ?>
                    <li><a href="GestionPedidos.php">Gestión de Pedidos</a></li>
                    <li><a href="perfil.php">Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión (<?= $_SESSION['nombre_completo']; ?>)</a></li>
                <?php else: ?>
                    <li><a href="login.php">Iniciar Sesión</a></li>
                    <li><a href="register.php">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
<main>

<h2>Términos y Condiciones</h2>
<p>Aquí se detallan los términos y condiciones de uso de la plataforma.</p>

</main>

    <footer>
        <p>© 2024 Tu Proyecto. Todos los derechos reservados.</p>
    
    </main>
    <footer>
        <p>© 2024 AgroConnect. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
