<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/formaatencion/entidadformaatencion.php';
require_once '../modelo/formaatencion/modeloformaatencion.php';
// Logica
$formaatt = new FormaAtencion();
$modelformaatt = new ModelFormaAtencion();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $formaatt->__SET('formaatencion_id',     $_REQUEST['formaattid']); //En vez de codatencion_id estaba repetido codatencion_codigo
            $formaatt->__SET('formaatencion_texto',  $_REQUEST['formaatt']);
            $formaatt->__SET('formaatencion_estado', $_REQUEST['formaattestado']);
            $jsondata = $modelformaatt->Actualizar($formaatt);
            echo json_encode($jsondata);
            break;

            case 'registrar':
            $formaatt->__SET('formaatencion_id',     $_REQUEST['formaattid']);
            $formaatt->__SET('formaatencion_texto',  $_REQUEST['formaatt']);
            $formaatt->__SET('formaatencion_estado', $_REQUEST['formaattestado']);
            $jsondata = $modelformaatt->Registrar($formaatt);
            echo json_encode($jsondata);
            break;

            case 'eliminar':
            $jsondata = $modelformaatt->Eliminar($_REQUEST['formaattid']);//Faltaba nombre asignado al id de codigo atencion
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelformaatt->Obtener($_REQUEST['formaattid']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelformaatt->Listar();
            echo json_encode($jsondata);
            break;            
        }
    }

    ?>