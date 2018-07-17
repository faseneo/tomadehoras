<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/facultad/entidadfacultad.php';
require_once '../modelo/facultad/modelfacultad.php';
// Logica
$facul = new Facultad();
$modelFacul = new ModelFacultad();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $facul->__SET('facultad_id',            $_REQUEST['']);
            $facul->__SET('facultad_nombre',        $_REQUEST['']);
            $jsondata = $modelFacul->Actualizar($facul);
			echo json_encode($jsondata);
            break;

        case 'registrar':
            $centroc->__SET('facultad_id',        $_REQUEST['']);
            $centroc->__SET('facultad_nombre',    $_REQUEST['']);
            $jsondata = $modelFacul->Registrar($facul);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelFacul->Eliminar($_REQUEST['']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelFacul->Obtener($_REQUEST['']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelFacul->Listar();
            echo json_encode($jsondata);
            break;            
    }
}

?>