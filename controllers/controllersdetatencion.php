<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/detalleatencion/entidaddetatencion.php';
require_once '../modelo/detalleatencion/modeldetatencion.php';
// Logica
$detatencion = new DetalleAtencion();
$modelDetAtencion = new ModelDetAtencion();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $detatencion->__SET('det_ate_id',             $_REQUEST['detAteId']);
            $detatencion->__SET('det_ate_texto',          $_REQUEST['detAteTxt']);
            $detatencion->__SET('det_ate_estado',         $_REQUEST['detAteEst']);
            $jsondata = $modelDetAtencion->Actualizar($detatencion);
			echo json_encode($jsondata);
            break;

        case 'registrar':
            $detatencion->__SET('det_ate_id',             $_REQUEST['detAteId']);
            $detatencion->__SET('det_ate_texto',          $_REQUEST['detAteTxt']);
            $detatencion->__SET('det_ate_estado',         $_REQUEST['detAteEst']);
            $jsondata = $modelDetAtencion->Registrar($detatencion);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelDetAtencion->Eliminar($_REQUEST['detAteId']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelDetAtencion->Obtener($_REQUEST['detAteId']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelDetAtencion->Listar();
            echo json_encode($jsondata);
            break;            
    }
}

?>