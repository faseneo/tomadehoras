<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelAsignaCarrera {
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
            $consulta = "SELECT COUNT(*) FROM asigna_carreras";
            $res = $this->pdo->query($consulta);
            if ($res->fetchColumn() == 0) {
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Asignación de Carreras sin elementos';                
                $jsonresponse['datos'] = [];
            }else{
                $result = array();
                $stm = $this->pdo->prepare("SELECT ascar.asigna_carreras_id,
                                                   ascar.asigna_carreras_personas_dae_id,
                                                   ascar.asigna_carreras_carrera_id,
                                                   ascar.asigna_carreras_fecha_asignacion,
                                                   ascar.asigna_carreras_estado
                                            FROM asigna_carreras as ascar");
                $stm->execute();
                foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                    $busq = new AsignaCarrera();
                        $busq->__SET('ascar_pers_id',  $r->asigna_carreras_personas_dae_id);
                        $busq->__SET('ascar_carr_id',  $r->asigna_carreras_carrera_id);
                        $busq->__SET('ascar_fecha',   $r->asigna_carreras_fecha_asignacion);
                        $busq->__SET('ascar_estado',  $r->asigna_carreras_estado);
                    $result[] = $busq->returnArray();
                }
                $jsonresponse['success'] = true;
                $jsonresponse['message'] = 'Asignación de Carreras listada correctamente';
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

    public function Listar_asignados($user_id){
        $jsonresponse = array();
        //var_dump($user_id);
        //exit;
        try{
            $result = array();
            $stm = $this->pdo->prepare("SELECT  *
                                        FROM asigna_carreras AS ac, carreras as ca
                                        WHERE ca.carrera_id = ac.asigna_carreras_carrera_id AND ac.asigna_carreras_personas_dae_id = ?
                                        and asigna_carreras_estado=1 ORDER BY ca.carrera_codigo");
            $stm->execute(array($user_id));
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                     $fila = array('carr_id'=>$r->carrera_id,
                                    'carr_cod'=>$r->carrera_codigo,
                                    'carr_nom'=>$r->carrera_nombre);
                $result[]=$fila;
            }
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'listado correctamente';
            $jsonresponse['datos'] = $result;
            return $jsonresponse;
        }
        catch(Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al listar las Carreras';
        }
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
                //quito el for para no crear arreglo de un resultado
                $r = $stm->fetch(PDO::FETCH_OBJ);
                    $busq = new CodigoAtencion();
                            $busq->__SET('codatencion_id',     $r->codigo_atencion_id);
                            $busq->__SET('codatencion_codigo', utf8_encode($r->codigo_atencion_codigo));
                            $busq->__SET('codatencion_obs',    utf8_encode($r->codigo_atencion_observacion));
                    $result = $busq->returnArray();

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
                                utf8_decode($data->__GET("codatencion_obs"))));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Codigo de Atencion ingresado correctamente'; 
        } catch (Exception $e){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Codigo de Atencion';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function GuardarAsignacion($usuid,$idcarreras){
        $uid=(int)$usuid;
        
        $carreras = explode(',', $idcarreras);
        $consultaexiste = "SELECT COUNT(*) FROM asigna_carreras WHERE asigna_carreras_personas_dae_id = $uid";
        $res = $this->pdo->query($consultaexiste);

         if ($res->fetchColumn() == 0) {
               
            }else{
                $eliminacarr = "UPDATE asigna_carreras set asigna_carreras_estado=0 WHERE asigna_carreras_personas_dae_id = $uid";
                $exec = $this->pdo->query($eliminacarr);
               
        }
        foreach ($carreras as $key => $value) {
            $stm = $this->pdo->prepare("INSERT INTO asigna_carreras (asigna_carreras_personas_dae_id, asigna_carreras_carrera_id,asigna_carreras_estado) VALUES (?,?,?)");

            $stm->execute(array($uid,
                                $value,
                                1
                                ));

        }
       $jsonresponse['success'] = true;
       $jsonresponse['message'] = 'Codigo de Atencion ingresado correctamente'; 
    }

    public function Actualizar(CodigoAtencion $data){
        $jsonresponse = array();
        try{

           $sql = "UPDATE codigo_atencion SET  codigo_atencion_codigo = ?, codigo_atencion_observacion = ? WHERE  codigo_atencion_id = ?";

            $this->pdo->prepare($sql)->execute(array($data->__GET('codatencion_codigo'), 
                                                     utf8_decode($data->__GET('codatencion_obs')),
                                                     $data->__GET('codatencion_id'))// agrego codigo_atencion_id faltante
                                                );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Código de Atención actualizado correctamente';                 
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