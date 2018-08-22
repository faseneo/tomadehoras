<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelPersonasDae {
    private $pdo;

    public function __CONSTRUCT(){
        try{
            $this->pdo = new PDO("mysql:host=".HOST.";dbname=".DB, USERDB, PASSDB);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function Listar(){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM personas_dae";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Personas Dae sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT 
                                                  *
                                            FROM personas_dae as persdae
                                            ");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new PersonasDae();
                        $busq->__SET('persdae_id',          $r->personas_dae_id);
                        $busq->__SET('persdae_nombres',     $r->personas_dae_nombres);
                        $busq->__SET('persdae_apellidos',   $r->personas_dae_apellidos);
                        $busq->__SET('persdae_correo',      $r->personas_dae_correo);
                        $busq->__SET('persdae_anexo',       $r->personas_dae_anexo);
                        $busq->__SET('persdae_id_usu',      $r->personas_dae_usuarios_id);

                    $result[] = $busq->returnArray();
                }
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuarios listados correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar las personas dae';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM personas_dae WHERE personas_dae_id=".$id;
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuario sin datos';                
                $jsonresponse['datos'] = [];
            }else{
            $stm = $this->pdo->prepare("SELECT *
                                        FROM personas_dae as persdae
                                        WHERE persdae.personas_dae_usuarios_id = ? ");
                $stm->execute(array($id));
                //quito el for para no crear arreglo de un resultado
                $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new PersonasDae();
                        $busq->__SET('persdae_id',          $r->personas_dae_id);
                        $busq->__SET('persdae_nombres',     $r->personas_dae_nombres);
                        $busq->__SET('persdae_apellidos',   $r->personas_dae_apellidos);
                        $busq->__SET('persdae_correo',      $r->personas_dae_correo);
                        $busq->__SET('persdae_anexo',       $r->personas_dae_anexo);
                        $busq->__SET('persdae_id_usu',      $r->personas_dae_usuarios_id);
                    $result = $busq->returnArray();

                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Se obtuvo datos del Usuario correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
            return $jsonresponse;
        } 
        catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener la Persona DAE';             
        }
        return $jsonresponse;
    }

    public function Eliminar($usu_id){
        $jsonresponse = array();
        try{
            //var_dump($usu_id); //con esto veo los datos que me llegan
            $stm = $this->pdo->prepare("DELETE FROM usuarios WHERE usuarios_id = ? ");
                    
                    $stm->execute(array($usu_id));
            
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Usuario eliminado correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar el Usuario';            
        }
        return $jsonresponse;
    }

    public function Registrar(PersonasDae $data){
        $jsonresponse = array();
        try{
 
            $stm = $this->pdo->prepare("INSERT INTO personas_dae (personas_dae_nombres, personas_dae_apellidos, personas_dae_correo, personas_dae_anexo, personas_dae_usuarios_id ) VALUES (?,?,?,?,?)");
            $stm->execute(array($data->__GET("persdae_nombres"),
                                $data->__GET("persdae_apellidos"),
                                $data->__GET("persdae_correo"),
                                $data->__GET("persdae_anexo"),
                                $data->__GET("persdae_id_usu"))
                         );

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Datos Personales ingresados correctamente'; 
        } catch (Exception $e){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Datos Personales';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(Usuarios $data){
        $jsonresponse = array();
        try{
            //var_dump($data); con esto veo los datos que me llegan
           $sql = "UPDATE usuarios SET  usuarios_username = ?, usuarios_password = md5(?), usuarios_activo = ?, usuarios_rol_id = ? WHERE  usuarios_id = ?";
            $this->pdo->prepare($sql)
                 ->execute(array($data->__GET('usu_username'), 
                                 $data->__GET('usu_password'),
                                 $data->__GET('usu_estado'),
                                 $data->__GET('usu_rol_id'),
                                 $data->__GET('usu_id'))
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Usuario actualizado correctamente';                 
        } catch (Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al actualizar '.$e->getMessage();             
        }
        return $jsonresponse;
    }

    public function Listar2(){
        $jsonresponse = array();
        try{
            $result = array();

            return $result;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
?>