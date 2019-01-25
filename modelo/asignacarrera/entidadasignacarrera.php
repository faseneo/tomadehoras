<?php
//carreras
class AsignaCarrera{
    private $ascar_pers_id;
    private $ascar_carr_id;
    private $ascar_fecha;
    private $ascar_estado;
    

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