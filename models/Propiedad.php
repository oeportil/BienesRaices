<?php 

namespace Model;

class Propiedad extends ActiveRecord{
    
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc'
    , 'estacionamiento', 'creado', 'id_vendedor'];
    public function __construct(protected $id=0 ,protected string $titulo='', 
    protected $precio='', protected $imagen='',protected string $descripcion='', protected $habitaciones='', 
    protected $wc='',protected  $estacionamiento='', protected string $creado='',protected $id_vendedor =0){
        $this->creado = date('Y/m/d');
    }


    public function getTitulo(){
        return $this->titulo;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getHabitaciones(){
        return $this->habitaciones;
    }
    public function getWc(){
        return $this->wc;
    }
    public function getEstacionamiento(){
        return $this->estacionamiento;
    }
    public function getIdVendedor(){
        return $this->id_vendedor;
    }
    public function validar(){
         
        if(!$this->titulo){
            self::$errores[] =  "Debes añadir un titulo";
        }
        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }
        if( strlen($this->descripcion) < 50  ){
            self::$errores[] = "la descripcion es obligatoria y debes escribir al menos 50 caracteres";
        }
        if(!$this->habitaciones){
            self::$errores[] = "numero de habitaciones es obligatorio";
        }
        if(!$this->wc){
            self::$errores[] = "numero de baños es obligatorio";
        }
        if(!$this->estacionamiento){
            self::$errores[] = "numero de lugares de estacionamiento es obligatorio";
        }
        if(!$this->id_vendedor){
            self::$errores[] = "elige vendedor";
        }
        if(!$this->imagen){
            self::$errores[] = "La imagen es Obligatoria";
        }
        return self::$errores;
    }
}