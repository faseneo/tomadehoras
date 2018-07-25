<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelDetAtencion {
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
            $stm = $this->pdo->prepare("SELECT  da.detalle_atencion_id,
                                                da.detalle_atencion_texto,
                                                da.detalle_atencion_estado
                                        FROM detalle_atencion as da");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new DetalleAtencion();
                    $busq->__SET('det_ate_id', $r->detalle_atencion_id);
                    $busq->__SET('det_ate_texto', $r->detalle_atencion_texto); 
                    $busq->__SET('det_ate_estado', $r->detalle_atencion_estado);                   
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
            $jsonresponse['message'] = 'Error al listar Detalles Atencion';
        }
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo
                       ->prepare("SELECT da.detalle_atencion_id,
                                         da.detalle_atencion_texto,
                                         da.detalle_atencion_estado
                                FROM detalle_atencion as da
                                WHERE da.detalle_atencion_id = ?");
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            $busq = new DetalleAtencion();
                    $busq->__SET('det_ate_id', $r->detalle_atencion_id);
                    $busq->__SET('det_ate_texto', $r->detalle_atencion_texto);
                    $busq->__SET('det_ate_estado', $r->detalle_atencion_estado);
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Se obtuvo Detalle Atencion correctamente';
            $jsonresponse['datos'] = $busq->returnArray();
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Detalle Atencion';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{  
            $stm = $this->pdo->prepare("DELETE FROM detalle_atencion WHERE detalle_atencion_id = ? ");
            $stm->execute(array($id));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Detalle Atencion eliminado correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Detalle Atencion';            
        }
        return $jsonresponse;
    }

    public function Registrar(DetalleAtencion $data){
        $jsonresponse = array();
        try{
            $sql = "INSERT INTO detalle_atencion (detalle_atencion_texto, detalle_atencion_estado) 
                    VALUES (?,?)";

            $this->pdo->prepare($sql)->execute(array(
                                                     $data->__GET('det_ate_texto'),
                                                     $data->__GET('det_ate_estado')
                                               ));
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Detalle Atencion ingresada correctamente'; 
        } catch (PDOException $pdoException){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Detalle Atencion';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(DetalleAtencion $data){    
        $jsonresponse = array();
        try{
            $sql = "UPDATE detalle_atencion SET 
                           detalle_atencion_texto = ?,
                           detalle_atencion_estado = ? 
                    WHERE  detalle_atencion_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(array($data->__GET('det_ate_texto'), 
                                 $data->__GET('det_ate_estado'),
                                 $data->__GET('det_ate_id'))
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Detalle Atencion actualizado correctamente';                 
        } catch (Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al actualizar Detalle Atencion';             
        }
        return $jsonresponse;
    }

    public function Listar2(){
        $jsonresponse = array();
        try{
            $result = array();
            $stm = $this->pdo->prepare("SELECT  da.detalle_atencion_id,
                                                da.detalle_atencion_texto,
                                                da.detalle_atencion_estado
                                        FROM detalle_atencion as da");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new DetalleAtencion();
                    $busq->__SET('det_ate_id', $r->detalle_atencion_id);
                    $busq->__SET('det_ate_texto', $r->detalle_atencion_texto); 
                    $busq->__SET('det_ate_estado', $r->detalle_atencion_estado);
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