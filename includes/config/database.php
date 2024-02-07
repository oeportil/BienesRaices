<?php
function conectarDB(): mysqli
{
    $db = new mysqli('mysql-bienesraices.alwaysdata.net', '346041', 'Administrador09*', 'bienesraices_mvc');

    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }
    return $db;
}
