<?php
//carreras
class Carreras{
    private $codatencion_id;
    private $codatencion_codigo;
    private $codatencion_obs;
    

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