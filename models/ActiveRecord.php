<?php 

namespace Model;

class ActiveRecord {
    //base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    // Errores 
    protected static $errores = [];


    public function actualizar(){
        $atributos = $this->sanitizarAtributos();
        
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = " $key='$value'";
        }
        $query = "UPDATE ".static::$tabla." SET ".join(', ', $valores). " WHERE id = '". self::$db->escape_string($this->id)."' "; 
        $query .= " LIMIT 1 ";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function eliminar(){
        $query = "DELETE FROM ".static::$tabla." WHERE id = ". self::$db->escape_string($this->id);
        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }
    public function guardar(){
                          
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        //Insertar en la base de datos
        $query = "INSERT INTO ".static::$tabla." ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ' )";


        
        $resultado = self::$db->query($query);
        return $resultado;

    }
    public static function setDB($database){
        self::$db = $database;
    }
    
    //identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if($columna == 'id' ) continue;
                $atributos[$columna] = $this->$columna; 
            
        }
        return $atributos;
    }
    
    
    public function sanitizarAtributos(): array {
        $atributos = $this->atributos();
        $sanitizado = [];
        
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //subida de archivos
    public function setImagen($imagen){
        //elimina la imagen previa
        if(isset($this->id)){
            $this->borrarImagen();
        }           
        if($imagen){
            $this->imagen = $imagen;
        }
        
    }
    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETAS_IMAGENES.$this->imagen);
            if($existeArchivo){
                unlink(CARPETAS_IMAGENES.$this->imagen);
                
            }
    }

    //validacion 
    public static function getErrores(): array{
        return static::$errores;
    }

    public function validar(){
        static::$errores=[];
        return static::$errores;
    }

    //listar todas las propiedades
    public static function all(): array {
        $query = "SELECT * FROM ". static::$tabla;
        //static va a heredar el metodo y va a buscar el atributo donde se esta heredando

        $resultado = self::ConsultarSQL($query);
        
        return $resultado;
    }
    public static function get($cantidad): array {
        $query = "SELECT * FROM ". static::$tabla. ' LIMIT '. $cantidad;
        //static va a heredar el metodo y va a buscar el atributo donde se esta heredando

        $resultado = self::ConsultarSQL($query);
        
        return $resultado;
    }

    //busca un registro por su id
    public static function find($i){
        $query = "SELECT * FROM ".static::$tabla." WHERE id = " . $i;
        $resultado = self::ConsultarSQL($query);
        return array_shift($resultado);
        //array shift sirve para retornar la primera posicion de un arreglo
        
    }

    public static function ConsultarSQL($query): array{
        //Consultar la base de datos
            $resultado = self::$db->query($query);
        //iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }
        //liberar la memoria
            $resultado->free();
        //retornar los resutados
        return $array;
    }
    protected static function crearObjeto($registro): object{
        $objeto = new static;

        foreach($registro as $key => $value){
            if( property_exists($objeto,$key) ){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    
    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []){
        foreach ($args as $key => $value){
            if(property_exists($this,$key)  && !is_null($value)){
                $this->$key = $value;
            }
        }
    }



    public function getId(){
        return $this->id;
    }
}



?>