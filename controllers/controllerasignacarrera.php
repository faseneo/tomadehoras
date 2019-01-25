<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/asignacarrera/entidadasignacarrera.php';
require_once '../modelo/carreras/entidadcarreras.php';
require_once '../modelo/asignacarrera/modeloasignacarrera.php';
// Logica
$asignacar = new AsignaCarrera();
$modelasignacar = new ModelAsignaCarrera();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $asignacar->__SET('codatencion_id',     $_REQUEST['asignacarid']); //En vez de codatencion_id estaba repetido codatencion_codigo
            $asignacar->__SET('codatencion_codigo', $_REQUEST['asignacar']);
            $asignacar->__SET('codatencion_obs',    $_REQUEST['descasignacar']);
            $jsondata = $modelasignacar->Actualizar($asignacar);
            echo json_encode($jsondata);
            break;

            case 'registrar':
            $asignacar->__SET('codatencion_id',     $_REQUEST['asignacarid']);
            $asignacar->__SET('codatencion_codigo', $_REQUEST['asignacar']);
            $asignacar->__SET('codatencion_obs',    $_REQUEST['descasignacar']);
            $jsondata = $modelasignacar->Registrar($asignacar);
            echo json_encode($jsondata);
            break;

            case 'eliminar':
            $jsondata = $modelasignacar->Eliminar($_REQUEST['asignacarid']);//Faltaba nombre asignado al id de codigo atencion
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelasignacar->Obtener($_REQUEST['asignacarid']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelasignacar->Listar();
            echo json_encode($jsondata);
            break;

            case 'listar_asignados':
            //var_dump($_REQUEST);
            $jsondata = $modelasignacar->Listar_asignados($_REQUEST['persona_dae_id']);
            echo json_encode($jsondata);
            break;            
        }
    }

    ?>