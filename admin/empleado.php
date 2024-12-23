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
            $empleados=$app->readAll();
            include('views/empleado/index.php');
            break;
        
        case 'actualizar':
            $empleados=$app->readOne($id);
            $usuarios= $appUsuario->readAll();
            include('views/empleado/crear.php');
            break;
            
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            if($result){
                $mensaje="Empleado actualizado correctamente";
                $tipo="success";
    
            } else {
                $mensaje="Hubo un error no se pudo actualizar el empleado";
                $tipo="danger";
            }
            $empleados=$app->readAll();
            include('views/empleado/index.php');
            break;
        
        case 'eliminar':
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "El empleado se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino el empleado";
                        $tipo = "danger";
                    }
                }
            }
            $empleados=$app->readAll();
            include('views/empleado/index.php');          
            break;
        
        case 'reporte':
            $app->reporte($id);
            break;
        
        default:
            $empleados=$app->readAll();
            include('views/empleado/index.php');
            break;
    }
?>