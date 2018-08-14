<?php
//Personas Dae
class PersonasDae{
    private $persdae_id;
    private $persdae_nombres;
    private $persdae_apellidos;
    private $persdae_correo;
    private $persdae_anexo;
    private $persdae_id_usu;
    

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