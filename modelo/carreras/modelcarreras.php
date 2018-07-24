<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelCarreras {
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
            $stm = $this->pdo->prepare("SELECT  ca.carrera_id,
                                                ca.carrera_codigo,
                                                ca.carrera_nombre,
                                                ca.carrera_facultad_id
                                        FROM carreras as ca, facultad as fa 
                                        WHERE ca.carrera_facultad_id= fa.facultad_id ");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new Carreras();
                    $busq->__SET('carr_id', $r->carrera_id);
                    $busq->__SET('carr_cod', $r->carrera_codigo);
                    $busq->__SET('carr_nom', $r->carrera_nombre);
                    $busq->__SET('carr_facul_id', $r->carrera_facultad_id);

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
            $jsonresponse['message'] = 'Error al listar las Carreras';
        }
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo
                       ->prepare("SELECT ca.carrera_id,
                                         ca.carrera_codigo,
                                         ca.carrera_nombre,
                                         ca.carrera_facultad_id
                                        FROM carreras as ca, facultad as fa 
                                        WHERE ca.carrera_facultad_id = fa.facultad_id
                                        AND ca.carrera_id = ?");
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            $busq = new Carreras();
                    $busq->__SET('carr_id', $r->carrera_id);
                    $busq->__SET('carr_cod', $r->carrera_codigo);
                    $busq->__SET('carr_nom', $r->carrera_nombre);
                    $busq->__SET('carr_facul_id', $r->carrera_facultad_id);
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Se obtuvo las Carreras correctamente';
            $jsonresponse['datos'] = $busq->returnArray();
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Carreras';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo->prepare("DELETE FROM carreras WHERE carrera_id = ? ");
            $stm->execute(array($id));
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Carrera eliminada correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Carrera';            
        }
        return $jsonresponse;
    }

    public function Registrar(Carreras $data){
        $jsonresponse = array();
        try{
             $sql = "INSERT INTO carreras (carrera_codigo, carrera_nombre, carrera_facultad_id) 
                    VALUES (?,?,?)";

            $this->pdo->prepare($sql)->execute(array($data->__GET('carr_cod'),
                                                     $data->__GET('carr_nom'),
                                                     $data->__GET('carr_facul_id'))
                                              );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Carrera ingresada correctamente'; 
        } catch (PDOException $pdoException){
        //echo 'Error crear un nuevo elemento busquedas en Registrar(...): '.$pdoException->getMessage();
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Carrera';
            $jsonresponse['errorQuery'] = $pdoException->getMessage(); 
        }
        return $jsonresponse;
    }

    public function Actualizar(Carreras $data){
        $jsonresponse = array();
        try{
            $sql = "UPDATE carreras SET 
                           carrera_codigo = ?,
                           carrera_nombre = ?,
                           carrera_facultad_id = ?
                    WHERE  carrera_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(array($data->__GET('carr_cod'), 
                                 $data->__GET('carr_nom'),
                                 $data->__GET('carr_facul_id'),
                                 $data->__GET('carr_id'))
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Carrera actualizada correctamente';                 
        } catch (Exception $e){
            //die($e->getMessage());
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al actualizar Carrera';             
        }
        return $jsonresponse;
    }

    public function Listar2(){
        $jsonresponse = array();
        try{
            $result = array();
             $stm = $this->pdo->prepare("SELECT  ca.carrera_id,
                                                 ca.carrera_codigo,
                                                 ca.carrera_nombre,
                                                 ca.carrera_facultad_id
                                        FROM carreras as ca");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new Carreras();
                    $busq->__SET('carr_id', $r->carrera_id);
                    $busq->__SET('carr_cod', $r->carrera_codigo);
                    $busq->__SET('carr_nom', $r->carrera_nombre);
                    $busq->__SET('carr_facul_id', $r->carrera_facultad_id);
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