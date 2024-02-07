<?php 

define('TEMPLATES_URL', __DIR__.'/templates');
define('FUNCIONES_URL', __DIR__.'funciones.php');
define('CARPETAS_IMAGENES', $_SERVER['DOCUMENT_ROOT'].'/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estadoAutenticado(){
    session_start();
    if(!$_SESSION['login']){
        header('Location: /');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa el HTML
function s($html){
    $s = htmlspecialchars($html);
    return $s;
}

//validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}
function mostrarNotificacion($codigo) {

    switch($codigo){
        case 1:
            return 'Creado Correctamente';
            break;
        case 2:
            return 'Actualizado Correctamente';
            break;
        case 3:
            return 'Eliminado Correctamente';
            break;
        default:
            return false;
            break;
    }

}

function ValidateORedirect(string $url){
     //validar que sea un id valido 
     $id = $_GET['id'];
     $id = filter_var($id, FILTER_VALIDATE_INT);
 
      if(!$id){
          header("Location: $url");
      }
      return $id;
}