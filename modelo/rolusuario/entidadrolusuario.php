<?php
//rol_usuario
class RolUsuario{
    private $rol_usu_id;
    private $rol_usu_nom;


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