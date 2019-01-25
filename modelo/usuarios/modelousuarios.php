<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelUsuarios {
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
            $consulta = "SELECT COUNT(*) FROM usuarios";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuarios sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT 
                                                  *
                                            FROM usuarios as user,rol_usuario as ru
                                            where ru.rol_id = user.usuarios_rol_id ");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new Usuarios();
                        $busq->__SET('usu_id',          $r->usuarios_id);
                        $busq->__SET('usu_username',    $r->usuarios_username);
                        $busq->__SET('usu_password',    $r->usuarios_password);
                        $busq->__SET('usu_rol_id',      $r->usuarios_rol_id);
                        $busq->__SET('usu_rol_nombre',  $r->rol_nombre);
                        $busq->__SET('usu_estado',      $r->usuarios_activo);

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
            $jsonresponse['message'] = 'Error al listar los Usuarios';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Listar_asistentes(){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM usuarios";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuarios sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT personas_dae_id, usuarios_username
                                            FROM usuarios as u,personas_dae as pd 
                                            where u.usuarios_id=personas_dae_usuarios_id AND usuarios_rol_id = 2 ");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    /*$busq = new Usuarios();
                        $busq->__SET('usu_id',          $r->usuarios_id);
                        $busq->__SET('usu_username',    $r->usuarios_username);
                        $busq->__SET('usu_password',    $r->usuarios_password);
                        $busq->__SET('usu_rol_id',      $r->usuarios_rol_id);
                        $busq->__SET('usu_rol_nombre',  $r->rol_nombre);
                        $busq->__SET('usu_estado',      $r->usuarios_activo);

                    $result[] = $busq->returnArray();*/

                    $fila = array('usu_dae_id'=>$r->personas_dae_id,
                                    'usu_username'=>$r->usuarios_username);
                $result[]=$fila;
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
            $jsonresponse['message'] = 'Error al listar los Usuarios';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM usuarios where usuarios_id=".$id;
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuario no existe';                
                $jsonresponse['datos'] = [];
            }else{
            $stm = $this->pdo->prepare("SELECT 
                                                *
                                        FROM usuarios as user,rol_usuario as ru
                                        WHERE ru.rol_id = user.usuarios_rol_id AND user.usuarios_id = ? ");
                $stm->execute(array($id));
                //quito el for para no crear arreglo de un resultado
                $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new Usuarios();
                            $busq->__SET('usu_id',        $r->usuarios_id);
                            $busq->__SET('usu_username',  $r->usuarios_username);
                            $busq->__SET('usu_password',  $r->usuarios_password);
                            $busq->__SET('usu_estado',    $r->usuarios_activo);
                            $busq->__SET('usu_rol_id',    $r->usuarios_rol_id);
                            $busq->__SET('usu_rol_nombre',$r->rol_nombre);

                    $result = $busq->returnArray();

                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Se obtuvo el Usuario correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
            return $jsonresponse;
        } 
        catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener el Usuario';             
        }
        return $jsonresponse;
    }

    public function Eliminar($usu_id){
        $jsonresponse = array();
        try{
            //var_dump($usu_id); //con esto veo los datos que me llegan
            $consulta = "SELECT COUNT(*) FROM personas_dae where personas_dae_usuarios_id=".$usu_id;
            $res = $this->pdo->query($consulta);

            

            if ($res->fetchColumn() != 0) {
                require_once("../modelo/personasdae/modelopersonasdae.php");
                $pd = new ModelPersonasDae();
                $var = $pd->Eliminar($usu_id);
                if($var['success'])
                $jsonresponse['message'] = 'Usuario y datos personales eliminados correctamente';
            }
            
            $stm = $this->pdo->prepare("DELETE FROM usuarios WHERE usuarios_id = ? ");
                $stm->execute(array($usu_id));
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Usuario eliminado correctamente';

        } catch (Exception $e){
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar el Usuario1';            
        }
        return $jsonresponse;
    }

    public function Registrar(Usuarios $data){
        $jsonresponse = array();
        try{
 
            $stm = $this->pdo->prepare("INSERT INTO usuarios (usuarios_username, usuarios_password, usuarios_activo, usuarios_rol_id) VALUES (?,md5(?),?,?)");
            $stm->execute(array($data->__GET("usu_username"),
                                $data->__GET("usu_password"),
                                $data->__GET("usu_estado"),
                                $data->__GET("usu_rol_id"))
                         );

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Usuario ingresado correctamente'; 
        } catch (Exception $e){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar nuevo Usuario';
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