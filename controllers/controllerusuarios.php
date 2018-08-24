<?php
header('Content-type: application/json; charset=utf-8');
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
require_once '../modelo/usuarios/entidadusuarios.php';
require_once '../modelo/usuarios/modelousuarios.php';

// Logica
$usuarios = new Usuarios();
$modelusuarios = new ModelUsuarios();
        //var_dump($_REQUEST);
if(isset($_REQUEST['Accion'])){

    switch($_REQUEST['Accion']){

        case 'actualizar':
            $usuarios->__SET('usu_username',  $_REQUEST['username']);
            $usuarios->__SET('usu_password',  $_REQUEST['pass']);
            $usuarios->__SET('usu_estado',    $_REQUEST['estado']);
            $usuarios->__SET('usu_rol_id',    $_REQUEST['rol']);
            $usuarios->__SET('usu_id',        $_REQUEST['id']);
            $jsondata = $modelusuarios->Actualizar($usuarios);
            echo json_encode($jsondata);
            break;

            case 'registrar':


            $usuarios->__SET('usu_username',  $_REQUEST['username']);
            $usuarios->__SET('usu_password',  $_REQUEST['pass']);
            $usuarios->__SET('usu_estado',    $_REQUEST['estado']);
            $usuarios->__SET('usu_rol_id',    $_REQUEST['rol']);
            if (validaform($usuarios)){
                $jsondata = $modelusuarios->Registrar($usuarios);
                echo json_encode($jsondata);
            }else{
                $jsonresponse['valida'] = false;
                $jsonresponse['message'] = 'No se pudo registrar Usuario, Rol invalido';
                $jsonresponse['datos'] = [];
                echo json_encode($jsonresponse);    
            }
            break;

            case 'eliminar':
            $jsondata = $modelusuarios->Eliminar($_REQUEST['usu_id']);
            echo json_encode($jsondata);
            break;

            case 'obtener':
            $jsondata = $modelusuarios->Obtener($_REQUEST['id']);
            echo json_encode($jsondata);            
            break;
            
            case 'listar':
            $jsondata = $modelusuarios->Listar();
            echo json_encode($jsondata);
            break;            
        }
    }
    function validaform($usuarios){
        require_once '../modelo/rolusuario/entidadrolusuario.php';
        require_once '../modelo/rolusuario/modelrolusuario.php';
        $modelRolUsu = new ModelRolUsuario();
        $jsondata = $modelRolUsu->Obtener($usuarios->__GET('usu_rol_id'));
        //var_dump(empty($jsondata['datos']));
        if(empty($jsondata['datos'])){
            return false;
        }else{
            return true;
        }
    }

    ?>