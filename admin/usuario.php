<?php
    require_once('usuario.class.php');
    require_once('seccion.class.php');
    require_once('invernadero.class.php');
    $appInvernadero = new Invernadero;
    $app = new Usuario;
    $appRoles = new Roles;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            $invernadero = $appInvernadero->readAll();
            include('views/usuario/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Sección dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar la sección";
                $tipo="danger";
            }
            $secciones=$app->readAll();
            include('views/seccion/index.php');
            break;

        case 'actualizar':
            $secciones=$app->readOne($id);
            $invernadero= $appInvernadero->readAll();
            include('views/seccion/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            $roles = $appRoles->readAll();
            
            //print_r($result);
            if($result){
                $mensaje="Sección actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar la sección";
                $tipo="danger";
            }
            $secciones=$app->readAll();
            include('views/seccion/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "La sección se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino la sección";
                        $tipo = "danger";
                    }
                }
            }
            $secciones=$app->readAll();
            include('views/seccion/index.php');
            
            break;
        default:
            $usuarios=$app->readAll();
            include('views/usuario/index.php');
    }

    require_once('views/footer.php');
?>