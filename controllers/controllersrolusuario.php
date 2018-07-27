<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/rolusuario/entidadrolusuario.php';
require_once '../modelo/rolusuario/modelrolusuario.php';
// Logica
$rolusu = new RolUsuario();
$modelRolUsu = new ModelRolUsuario();

if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $rolusu->__SET('rol_usu_id',        $_REQUEST['rolId']);
            $rolusu->__SET('rol_usu_nom',       $_REQUEST['rolNom']);
            $jsondata = $modelRolUsu->Actualizar($rolusu);
			echo json_encode($jsondata);
            break;

        case 'registrar':
            $rolusu->__SET('rol_usu_id',     $_REQUEST['rolId']);
            $rolusu->__SET('rol_usu_nom',    $_REQUEST['rolNom']);
            $jsondata = $modelRolUsu->Registrar($rolusu);
            echo json_encode($jsondata);
            break;

        case 'eliminar':
            $jsondata = $modelRolUsu->Eliminar($_REQUEST['rolId']);
            echo json_encode($jsondata);
            break;

        case 'obtener':
            $jsondata = $modelRolUsu->Obtener($_REQUEST['rolId']);
            echo json_encode($jsondata);            
            break;
            
        case 'listar':
            $jsondata = $modelRolUsu->Listar();
            echo json_encode($jsondata);
            break;            
    }
}

?>