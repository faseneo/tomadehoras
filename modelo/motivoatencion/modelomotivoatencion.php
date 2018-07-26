<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelMotivoAtencion {
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
            $consulta = "SELECT COUNT(*) FROM motivo_atencion";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Motivo de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT motatt.motivo_atencion_id,
                                                   motatt.motivo_atencion_texto,
                                                   motatt.motivo_atencion_estado
                                            FROM motivo_atencion as motatt");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new MotivoAtencion();
                        $busq->__SET('motivoatencion_id',     $r->motivo_atencion_id);
                        $busq->__SET('motivoatencion_texto',  utf8_encode($r->motivo_atencion_texto));
                        $busq->__SET('motivoatencion_estado', $r->motivo_atencion_estado);
                    $result[] = $busq->returnArray();
                }
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Motivos de Atención listados correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar los Motivos de Atención';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM motivo_atencion";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Motivos de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
            $stm = $this->pdo->prepare("SELECT motatt.motivo_atencion_id,
                                               motatt.motivo_atencion_texto,
                                               motatt.motivo_atencion_estado
                                        FROM motivo_atencion as motatt
                                        WHERE motatt.motivo_atencion_id = ? ");
                $stm->execute(array($id));
                //quito el for para no crear arreglo de un resultado
                $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new MotivoAtencion();
                            $busq->__SET('motivoatencion_id',     $r->motivo_atencion_id);
                            $busq->__SET('motivoatencion_texto',  utf8_encode($r->motivo_atencion_texto));
                            $busq->__SET('motivoatencion_estado', $r->motivo_atencion_estado);
                    $result = $busq->returnArray();

                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Se obtuvo el Motivo de Atencion correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
            return $jsonresponse;
        } 
        catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Motivo de Atencion';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo->prepare("DELETE FROM motivo_atencion WHERE motivo_atencion_id = ? ");
                    
                    $stm->execute(array($id));
            
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Motivo de Atencion eliminado correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Motivo de Atencion';            
        }
        return $jsonresponse;
    }

    public function Registrar(MotivoAtencion $data){
        $jsonresponse = array();
        try{
 
            $stm = $this->pdo->prepare("INSERT INTO motivo_atencion (motivo_atencion_texto, motivo_atencion_estado) VALUES (?,?)");
            $stm->execute(array($data->__GET("motivoatencion_texto"),
                                utf8_decode($data->__GET("motivoatencion_estado"))));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Motivo de Atencion ingresado correctamente'; 
        } catch (Exception $e){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Motivo de Atencion';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(MotivoAtencion $data){
        $jsonresponse = array();
        try{

           $sql = "UPDATE motivo_atencion SET  motivo_atencion_texto = ?, motivo_atencion_estado = ? WHERE  motivo_atencion_id = ?";
            $this->pdo->prepare($sql)
                 ->execute(array(utf8_decode($data->__GET('motivoatencion_texto')), 
                                 $data->__GET('motivoatencion_estado'),
                                 $data->__GET('motivoatencion_id'))// agrego codigo_atencion_id faltante
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Motivo de Atención actualizado correctamente';                 
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