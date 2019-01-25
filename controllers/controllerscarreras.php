<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/carreras/entidadcarreras.php';
require_once '../modelo/carreras/modelcarreras.php';
// Logica
$carr = new Carreras();
$modelCarr = new ModelCarreras();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $carr->__SET('carr_id',             $_REQUEST['carrId']);
            $carr->__SET('carr_cod',            $_REQUEST['carrCod']);
            $carr->__SET('carr_nom',            $_REQUEST['carrNom']);
            $carr->__SET('carr_facul_id',       $_REQUEST['carrFacId']);
            $jsondata = $modelCarr->Actualizar($carr);
			echo json_encode($jsondata);
            break;

        case 'registrar':
            $carr->__SET('carr_id',             $_REQUEST['carrId']);
            $carr->__SET('carr_cod',            $_REQUEST['carrCod']);
            $carr->__SET('carr_nom',            $_REQUEST['carrNom']);
            $carr->__SET('carr_facul_id',       $_REQUEST['carrFac']);
            $jsondata = $modelCarr->Registrar($carr);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelCarr->Eliminar($_REQUEST['carrId']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelCarr->Obtener($_REQUEST['carrId']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelCarr->Listar();
            echo json_encode($jsondata);
            break;

        case 'listar_car_disp':
            $jsondata = $modelCarr->Listar_car_disp();
            echo json_encode($jsondata);
            break;                
    }
}

?>