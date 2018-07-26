<?php
//Motivos de atención
class MotivoAtencion{
    private $motivoatencion_id;
    private $motivoatencion_texto;
    private $motivoatencion_estado;
    

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