<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../../build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ?  'inicio': '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono-menu-responsive">
                </div>

                <div class="derecha">
                    <img class="darkmode-boton" src="/build/img/dark-mode.svg" alt="">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="./anuncios.php">Anuncios</a>
                        <a href="./blog.php">Blog</a>
                        <a href="./contacto.php">Contacto</a>
                        <?php if($auth): ?>
                        <a href="./Cerrar_Sesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <!-- Cierre de la barra -->
            <?php if($inicio){ ?>
            <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php } ?>
        </div>
    </header>