<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelFormaAtencion {
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
            $consulta = "SELECT COUNT(*) FROM forma_atencion";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Formas de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT formaatt.forma_atencion_id,
                                                   formaatt.forma_atencion_texto,
                                                   formaatt.forma_atencion_estado
                                            FROM forma_atencion as formaatt");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new FormaAtencion();
                        $busq->__SET('formaatencion_id',    $r->forma_atencion_id);
                        $busq->__SET('formaatencion_texto', utf8_encode($r->forma_atencion_texto));
                        $busq->__SET('formaatencion_estado',utf8_encode($r->forma_atencion_estado));
                    $result[] = $busq->returnArray();
                }
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Formas de Atención listadas correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar las Formas de Atención';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM forma_atencion";

            $res = $this->pdo->query($consulta);


            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Formas de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
            $stm = $this->pdo->prepare("SELECT formaatt.forma_atencion_id,
                                               formaatt.forma_atencion_texto,
                                               formaatt.forma_atencion_estado
                                        FROM forma_atencion as formaatt
                                        WHERE formaatt.forma_atencion_id = ? ");
                $stm->execute(array($id));
                //quito el for para no crear arreglo de un resultado
                $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new FormaAtencion();
                            $busq->__SET('formaatencion_id',    $r->forma_atencion_id);
                            $busq->__SET('formaatencion_texto', utf8_encode($r->forma_atencion_texto));
                            $busq->__SET('formaatencion_estado',utf8_encode($r->forma_atencion_estado));
                    $result = $busq->returnArray();

                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Se obtuvo la Forma de Atencion correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
            return $jsonresponse;
        } 
        catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener la Forma de Atencion';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo->prepare("DELETE FROM forma_atencion WHERE forma_atencion_id = ? ");
                    
                    $stm->execute(array($id));
            
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Forma de Atencion eliminada correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Forma de Atencion';            
        }
        return $jsonresponse;
    }

    public function Registrar(FormaAtencion $data){
        $jsonresponse = array();
        try{
 
            $stm = $this->pdo->prepare("INSERT INTO forma_atencion (forma_atencion_texto, forma_atencion_estado) VALUES (?,?)");
            $stm->execute(array($data->__GET("formaatencion_texto"),
                                utf8_decode($data->__GET("formaatencion_estado"))));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Forma de Atencion ingresada correctamente'; 
        } catch (Exception $e){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar la Forma de Atencion';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(FormaAtencion $data){
        $jsonresponse = array();
        try{

           $sql = "UPDATE forma_atencion SET  forma_atencion_texto = ?, forma_atencion_estado = ? WHERE  forma_atencion_id = ?";
            $this->pdo->prepare($sql)
                 ->execute(array(utf8_decode($data->__GET('formaatencion_texto')), 
                                 $data->__GET('formaatencion_estado'),
                                 $data->__GET('formaatencion_id'))// agrego codigo_atencion_id faltante
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Forma de Atención actualizada correctamente';                 
        } catch (Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al actualizar ';             
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