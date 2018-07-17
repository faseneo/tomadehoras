<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/codigoatencion/entidadcodatencion.php';
require_once '../modelo/codigoatencion/modelocodatencion.php';
// Logica
$codatt = new CodigoAtencion();
$modelcodatt = new ModelCodAtencion();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
/*            $centroc->__SET('ccosto_codigo',        $_REQUEST['ccCodigo']);
            $centroc->__SET('ccosto_nombre',        $_REQUEST['ccNombre']);
            $centroc->__SET('ccosto_dep_codigo',    $_REQUEST['ccDependencia']);*/
            $jsondata = $modelcodatt->Actualizar($centroc);
			echo json_encode($jsondata);
            break;

        case 'registrar':
/*            $centroc->__SET('ccosto_codigo',    $_REQUEST['ccCodigo']);
            $centroc->__SET('ccosto_nombre',    $_REQUEST['ccNombre']);
            $centroc->__SET('ccosto_dep_codigo',$_REQUEST['ccDependencia']);*/
            $jsondata = $modelcodatt->Registrar($centroc);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelcodatt->Eliminar($_REQUEST['ccCodigo']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelcodatt->Obtener($_REQUEST['id']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelcodatt->Listar();
            echo json_encode($jsondata);
            break;            
    }
}

?>