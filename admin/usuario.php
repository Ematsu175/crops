<?php
    require_once('usuario.class.php');
    include('roles.class.php');
    $app = new Usuario;
    $appRoles = new Roles;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':            
            $roles=$appRoles->readAll();
            //print_r($roles);
            include('views/usuario/crear.php');
            break;
        case 'nuevo':
            $data=$_POST;
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Usuario dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar el usuario";
                $tipo="danger";
            }
            $usuarios=$app->readAll();
            include('views/usuario/index.php');
            break;

        case 'actualizar':
            $usuarios=$app->readOne($id);
            $roles=$appRoles->readAll();
            $misRoles=$app->readAllRoles($id);
            
            include('views/usuario/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST;
            
            $result = $app->update($id,$data);
            //print_r($result);
            if($result){
                $mensaje="Usuario actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar el usuario";
                $tipo="danger";
            }
            $usuarios=$app->readAll();
            include('views/usuario/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "El permiso se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino el permiso";
                        $tipo = "danger";
                    }
                }
            }
            $usuarios=$app->readAll();
            include('views/usuario/index.php');
            
            break;
        default:
            $usuarios=$app->readAll();
            include('views/usuario/index.php');
    }

    require_once('views/footer.php');
?>