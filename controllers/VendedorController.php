<?php 
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{

    public static function crear(Router $router){
        
        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    
            $vendedor = new Vendedor(0, $_POST['nombre'], $_POST['apellido'], $_POST['telefono']);
         
            //validar que no haya campos vacios
            $errores = $vendedor->validar();
         
            //no hay errores
            if(empty($errores)){
                 $resultados = $vendedor->guardar();
         
                 if($resultados){
                     //redireccionar al usuario
                     header("Location: /admin?resultado=1");
                 }
         
            }
         
         
           }


        $router->render('vendedores/crear',[
            'errores'=>$errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router){

        $id = ValidateORedirect('/admin');
        $errores = Vendedor::getErrores();

        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
  
            $vendedor->sincronizar($_POST);
    
            $errores = $vendedor->validar();
    
            if(empty($errores)){
                $resultado= $vendedor->actualizar();
                     
                if($resultado){
                    //redireccionar al usuario
                    header("Location: /admin?resultado=2");
                }
            }
    
      }


        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $tipo = $_SERVER['tipo'];

            //validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }

}



?>