<?php
//Formas de atención
class FormaAtencion{
    private $formaatencion_id;
    private $formaatencion_texto;
    private $formaatencion_estado;
    

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