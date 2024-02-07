<?php 

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido','telefono'];    

    public function __construct(protected $id=0 ,protected string $nombre='', 
    protected $apellido='', protected $telefono=''){ 
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] =  "El nombre es obligatorio";
        }
        if(!$this->apellido){
            self::$errores[] =  "El  apellido es obligatorio";
        }
        if(!$this->telefono){
            self::$errores[] =  "El telefono es obligatorio";
        }
        if(!preg_match('/[0-9]{8}/',$this->telefono)){
            self::$errores[] =  "El telefono no es valido";
        }

        return self::$errores;
    }


    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getTelefono(){
        return $this->telefono;
    }
}


?>