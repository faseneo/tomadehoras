<?php
//carreras
class Carreras{
    private $carr_id;
    private $carr_cod;
    private $carr_nom;
    private $carr_facul_id;
    private $carr_facul_nombre;
    

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