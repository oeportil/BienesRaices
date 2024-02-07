<?php 

    
    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;
    
    class PropiedadController{
        
        public static function index(Router $router){
            
            $propiedades = Propiedad::all();

            $vendedores = Vendedor::all();
            $resultado = $_GET['resultado'] ?? null;

            $router->render('propiedades/admin',[
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores
            ]);
        }
        public static function crear(Router $router){
            $propiedad = new Propiedad();
            $errores = Propiedad::getErrores();
            $vendedores = Vendedor::all();


            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $propiedad = new Propiedad(0, $_POST['titulo'], $_POST['precio'], '' ,$_POST['descripcion'], $_POST['habitaciones'], $_POST['wc'], $_POST['estacionamiento'], date('Y/m/d') , $_POST['id_vendedor']);
                
                //Generar un nombre unico
                $nombreImagen = md5(uniqid(rand(), true)).'.jpg';
                
                if($_FILES['imagen']['tmp_name']){
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                    $propiedad->setImagen($nombreImagen);
                }
                
                
                $errores = $propiedad->validar();                
                
                //Revisar que el arreglo de errores esta vacio
                if(empty($errores)){        
                    
                    // //subir imagen sin intervention image
                    // move_uploaded_file($imagen['tmp_name'], $carpeta . $nombreImagen);
                    if(!is_dir(CARPETAS_IMAGENES)){
                        mkdir(CARPETAS_IMAGENES);
                    }   
                    //guardar imagen en el servidor con intervention
                    $image->save(CARPETAS_IMAGENES.$nombreImagen);
                    
                    $resultados = $propiedad->guardar();
        
                    //guardar con mysqli
                    // $resultado = mysqli_query($db, $query);
                    
                    if($resultados){
                        //redireccionar al usuario
                        header("Location: /admin?resultado=1");
                    }
                }       
            }  


            $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
        }
        public static function actualizar(Router $router){
            $id = ValidateORedirect('/admin');
            $propiedad = Propiedad::find($id);

            $vendedores = Vendedor::all();

            $errores = Propiedad::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
                $propiedad->sincronizar($_POST);
               
                $errores = $propiedad->validar();
                // debuguear($propiedad);
                
                $nombreImagen = md5(uniqid(rand(), true)).'.jpg';
        
                 if($_FILES['imagen']['tmp_name']){
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                    $propiedad->setImagen($nombreImagen);
                }
                
        
                //Revisar que el arreglo de errores esta vacio
                if(empty($errores)){
                    if($_FILES['imagen']['tmp_name']){
                        $image->save(CARPETAS_IMAGENES . $nombreImagen);
                    }
                    $resultado= $propiedad->actualizar();
                         
                    if($resultado){
                        //redireccionar al usuario
                        header("Location: /admin?resultado=2");
                    }
                }
        
        
                
            }

            $router->render('/propiedades/actualizar',[
                'propiedad' => $propiedad,
                'errores' => $errores,
                'vendedores' => $vendedores
                ]);
        }
        public static function eliminar(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);          
        
        
                if($id){
                    $tipo = $_POST['tipo'];
        
                  if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);                        
                    $propiedad->eliminar();
                  }                   
                }
            }
        }
    }



 ?>