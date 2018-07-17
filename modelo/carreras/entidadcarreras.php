<?php
//carreras
class Carreras{
    private $carrera_id;
    private $carrera_codigo;
    private $carrera_nombre;
    private $carrera_facultad_id;

    public function __GET($k){
        return $this->$k;
    }

    public function __SET($k, $v){
        return $this->$k = $v;
    }

    public function returnArray(){
    	return get_object_vars($this);
    } 
    
}
?>   