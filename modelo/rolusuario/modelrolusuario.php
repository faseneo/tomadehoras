<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelRolUsuario {
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
            $result = array();
            $stm = $this->pdo->prepare("SELECT  ru.rol_id,
                                                ru.rol_nombre
                                        FROM rol_usuario as ru");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new RolUsuario();
                    $busq->__SET('rol_usu_id', $r->rol_id);
                    $busq->__SET('rol_usu_nom', $r->rol_nombre);                   
                $result[] = $busq->returnArray();
            }
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'listado correctamente';
            $jsonresponse['datos'] = $result;
            return $jsonresponse;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar Rol Usuario';
        }
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM rol_usuario where rol_id=".$id;
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Este rol no existe';                
                $jsonresponse['datos'] = [];
            }else{
                    $stm = $this->pdo->prepare("SELECT ru.rol_id,
                                                 ru.rol_nombre
                                        FROM rol_usuario as ru
                                        WHERE ru.rol_id = ?");
                    $stm->execute(array($id));
                    $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new RolUsuario();
                            $busq->__SET('rol_usu_id', $r->rol_id);
                            $busq->__SET('rol_usu_nom', $r->rol_nombre);
                    $jsonresponse['success'] = true;
                    $jsonresponse['message'] = 'Se obtuvo Rol Usuario correctamente';
                    $jsonresponse['datos'] = $busq->returnArray();
                }
            $res=null;
            return $jsonresponse;
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Rol Usuario';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{  
            $stm = $this->pdo->prepare("DELETE FROM rol_usuario WHERE rol_id = ? ");
            $stm->execute(array($id));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Rol Usuario eliminado correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Rol Usuario';            
        }
        return $jsonresponse;
    }

    public function Registrar(RolUsuario $data){
        $jsonresponse = array();
        try{
            $sql = "INSERT INTO rol_usuario (rol_nombre) 
                    VALUES (?)";

            $this->pdo->prepare($sql)->execute(array(
                                                     $data->__GET('rol_usu_nom')
                                               ));
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Rol Usuario ingresado correctamente'; 
        } catch (PDOException $pdoException){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Rol Usuario';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(RolUsuario $data){    
        $jsonresponse = array();
        try{
            $sql = "UPDATE rol_usuario SET 
                           rol_nombre = ?
                    WHERE  rol_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(array($data->__GET('rol_usu_nom'), 
                                 $data->__GET('rol_usu_id'))
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Rol Usuario actualizado correctamente';                 
        } catch (Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al actualizar Rol Usuario';             
        }
        return $jsonresponse;
    }

    public function Listar2(){
        $jsonresponse = array();
        try{
            $result = array();
            $stm = $this->pdo->prepare("SELECT  ru.rol_id,
                                                ru.rol_nombre
                                        FROM rol_usuario as ru");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new RolUsuario();
                    $busq->__SET('rol_usu_id', $r->rol_id);
                    $busq->__SET('rol_usu_nom', $r->rol_nombre); 
                $result[] = $busq;
            }
            return $result;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

}
?>