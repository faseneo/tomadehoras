<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/personasdae/entidadpersonasdae.php';
require_once '../modelo/personasdae/modelopersonasdae.php';
// Logica
$persdae = new PersonasDae();
$modelpersdae = new ModelPersonasDae();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Acciondae'])){

    switch($_REQUEST['Acciondae']){

        case 'actualizar':
            $persdae->__SET('usu_username',  $_REQUEST['username']);
            $persdae->__SET('usu_password',  $_REQUEST['pass']);
            $persdae->__SET('usu_estado',    $_REQUEST['estado']);
            $persdae->__SET('usu_rol_id',    $_REQUEST['rol']);
            $persdae->__SET('usu_id',        $_REQUEST['id']);
            $jsondata = $modelpersdae->Actualizar($persdae);
            echo json_encode($jsondata);
            break;

            case 'registrar':
            $persdae->__SET('persdae_nombres',  $_REQUEST['nombres']);
            $persdae->__SET('persdae_apellidos',  $_REQUEST['apellidos']);
            $persdae->__SET('persdae_correo',    $_REQUEST['correo']);
            $persdae->__SET('persdae_anexo',    $_REQUEST['anexo']);
            $persdae->__SET('persdae_id_usu',    $_REQUEST['usu_id']);
            $jsondata = $modelpersdae->Registrar($persdae);
            echo json_encode($jsondata);
            break;

            case 'eliminar':
            $jsondata = $modelpersdae->Eliminar($_REQUEST['usu_id']);
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelpersdae->Obtener($_REQUEST['usu_id']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelpersdae->Listar();
            echo json_encode($jsondata);
            break;            
        }
    }

    ?>