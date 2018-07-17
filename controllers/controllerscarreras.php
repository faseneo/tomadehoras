<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/carreras/entidad........php';
require_once '../modelo/carreras/model.......php';
// Logica
$entidad = new Clase_de_la_entidad();
$modelentidad = new Model_de_la_entidad();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
/*            $centroc->__SET('ccosto_codigo',        $_REQUEST['ccCodigo']);
            $centroc->__SET('ccosto_nombre',        $_REQUEST['ccNombre']);
            $centroc->__SET('ccosto_dep_codigo',    $_REQUEST['ccDependencia']);*/
            $jsondata = $modelCentroc->Actualizar($centroc);
			echo json_encode($jsondata);
            break;

        case 'registrar':
/*            $centroc->__SET('ccosto_codigo',    $_REQUEST['ccCodigo']);
            $centroc->__SET('ccosto_nombre',    $_REQUEST['ccNombre']);
            $centroc->__SET('ccosto_dep_codigo',$_REQUEST['ccDependencia']);*/
            $jsondata = $modelCentroc->Registrar($centroc);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelCentroc->Eliminar($_REQUEST['ccCodigo']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelCentroc->Obtener($_REQUEST['ccCodigo']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelCentroc->Listar();
            echo json_encode($jsondata);
            break;            
    }
}

?>