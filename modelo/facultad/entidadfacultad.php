<?php
//facultad
class Facultad{
    private $facul_id;
    private $facul_nom;


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