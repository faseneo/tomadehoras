<?php
//Usuarios
class Usuarios{
    private $usu_username;
    private $usu_password;
    private $usu_estado;
    private $usu_rol_id;
    private $usu_rol_nombre;
    

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