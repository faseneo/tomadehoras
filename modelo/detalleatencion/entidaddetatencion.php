<?php
//detalle_atencion
class DetalleAtencion{
    private $det_ate_id;
    private $det_ate_texto;
    private $det_ate_estado;


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