<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelCodAtencion {
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
            $consulta = "SELECT COUNT(*) FROM codigo_atencion";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Códigos de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT codatt.codigo_atencion_id,
                                                   codatt.codigo_atencion_codigo,
                                                   codatt.codigo_atencion_observacion
                                            FROM codigo_atencion as codatt");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new CodigoAtencion();
                        $busq->__SET('codatencion_id', $r->codigo_atencion_id);
                        $busq->__SET('codatencion_codigo', utf8_encode($r->codigo_atencion_codigo));
                        $busq->__SET('codatencion_obs', utf8_encode($r->codigo_atencion_observacion));
                    $result[] = $busq->returnArray();
                }
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Códigos de Atención listados correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar los Codigos de Atención';
            $jsonresponse['datos'] = null;
        }
        $this->pdo=null;
        return $jsonresponse;
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $consulta = "SELECT COUNT(*) FROM codigo_atencion";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Codigos de Atención sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
            $stm = $this->pdo->prepare("SELECT codatt.codigo_atencion_id,
                                               codatt.codigo_atencion_codigo,
                                               codatt.codigo_atencion_observacion
                                        FROM codigo_atencion as codatt
                                        WHERE codatt.codigo_atencion_id = ? ");
                $stm->execute(array($id));
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new CodigoAtencion();
                            $busq->__SET('codatencion_id', $r->codigo_atencion_id);
                            $busq->__SET('codatencion_codigo', utf8_encode($r->codigo_atencion_codigo));
                            $busq->__SET('codatencion_obs', utf8_encode($r->codigo_atencion_observacion));

                    $result[] = $busq->returnArray();
                }         
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Se obtuvo el Codigo de Atencion correctamente';
                $jsonresponse['datos'] = $result;
                $stm=null;
            }
            $res=null;
            return $jsonresponse;
        } 
        catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Codigo de Atencion';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo->prepare("DELETE FROM codigo_atencion WHERE codigo_atencion_id = ? ");
                    
                    $stm->execute(array($id));
            
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Codigo de Atencion eliminado correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Codigo de Atencion';            
        }
        return $jsonresponse;
    }


    public function Registrar(CodigoAtencion $data){

        $jsonresponse = array();
        try{
 
            $stm = $this->pdo->prepare("INSERT INTO codigo_atencion (codigo_atencion_codigo, codigo_atencion_observacion) VALUES (?,?)");
            $stm->execute(array($data->__GET("codatencion_codigo"),
                                $data->__GET("codatencion_obs")));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Codigo de Atencion ingresado correctamente'; 
        } catch (PDOException $pdoException){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
           /* $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Codigo de Atencion';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();*/
        }
        return $jsonresponse;
    }
/*
    public function Actualizar(CentroCostos $data){
        $jsonresponse = array();
        try{
           
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = ' actualizado correctamente';                 
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
    }*/
}
?>