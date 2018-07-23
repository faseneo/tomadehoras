<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/codigoatencion/entidadcodatencion.php';
require_once '../modelo/codigoatencion/modelocodatencion.php';
// Logica
$codatt = new CodigoAtencion();
$modelcodatt = new ModelCodAtencion();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $codatt->__SET('codatencion_id',     $_REQUEST['codattid']); //En vez de codatencion_id estaba repetido codatencion_codigo
            $codatt->__SET('codatencion_codigo', $_REQUEST['codatt']);
            $codatt->__SET('codatencion_obs',    $_REQUEST['desccodatt']);
            $jsondata = $modelcodatt->Actualizar($codatt);
            echo json_encode($jsondata);
            break;

            case 'registrar':
            $codatt->__SET('codatencion_id',     $_REQUEST['codattid']);
            $codatt->__SET('codatencion_codigo', $_REQUEST['codatt']);
            $codatt->__SET('codatencion_obs',    $_REQUEST['desccodatt']);
            $jsondata = $modelcodatt->Registrar($codatt);
            echo json_encode($jsondata);
            break;

            case 'eliminar':
            $jsondata = $modelcodatt->Eliminar($_REQUEST['codattid']);//Faltaba nombre asignado al id de codigo atencion
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelcodatt->Obtener($_REQUEST['codattid']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelcodatt->Listar();
            echo json_encode($jsondata);
            break;            
        }
    }

    ?>