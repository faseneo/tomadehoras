<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once("../config/config.php");
class ModelFacultad {
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
            $stm = $this->pdo->prepare("SELECT  fa.facultad_id,
                                                fa.facultad_nombre
                                        FROM facultad as fa");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new Facultad();
                    $busq->__SET('facul_id', $r->facultad_id);
                    $busq->__SET('facul_nom', $r->facultad_nombre);                    
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
            $jsonresponse['message'] = 'Error al listar las Facultades';
        }
    }

    public function Obtener($id){
        $jsonresponse = array();
        try{
            $stm = $this->pdo
                       ->prepare("SELECT fa.facultad_id,
                                         fa.facultad_nombre
                                FROM facultad as fa
                                WHERE fa.facultad_id = ?");
            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);
            $busq = new Facultad();
                    $busq->__SET('facul_id', $r->facultad_id);
                    $busq->__SET('facul_nom', $r->facultad_nombre);
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Se obtuvo Facultad correctamente';
            $jsonresponse['datos'] = $busq->returnArray();
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al obtener Facultades';             
        }
        return $jsonresponse;
    }

    public function Eliminar($id){
        $jsonresponse = array();
        try{  
            $stm = $this->pdo->prepare("DELETE FROM facultad WHERE facultad_id = ? ");
            $stm->execute(array($id));

            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Facultad eliminada correctamente';              
        } catch (Exception $e){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al eliminar Facultad';            
        }
        return $jsonresponse;
    }

    public function Registrar(Facultad $data){
        $jsonresponse = array();
        try{
            $sql = "INSERT INTO facultad (facultad_nombre) 
                    VALUES (?)";

            $this->pdo->prepare($sql)->execute(array($data->__GET('facul_nom'))
                                              );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Facultad ingresada correctamente'; 
        } catch (PDOException $pdoException){
            $jsonresponse['success'] = false;
            $jsonresponse['message'] = 'Error al ingresar Facultad';
            $jsonresponse['errorQuery'] = $pdoException->getMessage();
        }
        return $jsonresponse;
    }

    public function Actualizar(Facultad $data){    
        $jsonresponse = array();
        try{
            $sql = "UPDATE facultad SET 
                           facultad_nombre = ?
                    WHERE  facultad_id = ?";

            $this->pdo->prepare($sql)
                 ->execute(array($data->__GET('facul_nom'), 
                                 $data->__GET('facul_id'))
                          );
            $jsonresponse['success'] = true;
            $jsonresponse['message'] = 'Facultad actualizada correctamente';                 
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
             $stm = $this->pdo->prepare("SELECT  fa.facultad_id,
                                                 fa.facultad_nombre
                                        FROM facultad as fa");
            $stm->execute();
            foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r){
                $busq = new Facultad();
                    $busq->__SET('facul_id', $r->facultad_id);
                    $busq->__SET('facul_nom', $r->facultad_nombre);
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