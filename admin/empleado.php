<?php 
    require_once('empleado.class.php');
    require_once('usuario.class.php');
    $app = new Empleado;
    $appUsuario = new Usuario;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch ($accion) {
        case 'crear':
            $usuarios = $appUsuario->readAll();
            include('views/empleado/crear.php');
            break;

        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Empleado dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar el empleado";
                $tipo="danger";
            }
            $secciones=$app->readAll();
            include('views/empleado/index.php');
            break;
        
        case 'actualizar':
            break;
        
        case 'modificar':
            break;
        
        case 'eliminar':
            break;
        
        default:
            $empleados=$app->readAll();
            include('views/empleado/index.php');
            break;
    }
?>