<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/motivoatencion/entidadmotivoatencion.php';
require_once '../modelo/motivoatencion/modelomotivoatencion.php';
// Logica
$motivoatt = new MotivoAtencion();
$modelmotivoatt = new ModelMotivoAtencion();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $motivoatt->__SET('motivoatencion_id',     $_REQUEST['motivoattid']);
            $motivoatt->__SET('motivoatencion_texto',  $_REQUEST['motivoatt']);
            $motivoatt->__SET('motivoatencion_estado', $_REQUEST['motivoattestado']);
            $jsondata = $modelmotivoatt->Actualizar($motivoatt);
            echo json_encode($jsondata);
            break;

            case 'registrar':
            $motivoatt->__SET('motivoatencion_id',     $_REQUEST['motivoattid']);
            $motivoatt->__SET('motivoatencion_texto',  $_REQUEST['motivoatt']);
            $motivoatt->__SET('motivoatencion_estado', $_REQUEST['motivoattestado']);
            $jsondata = $modelmotivoatt->Registrar($motivoatt);
            echo json_encode($jsondata);
            break;

            case 'eliminar':
            $jsondata = $modelmotivoatt->Eliminar($_REQUEST['motivoattid']);
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelmotivoatt->Obtener($_REQUEST['motivoattid']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelmotivoatt->Listar();
            echo json_encode($jsondata);
            break;            
        }
    }

    ?>