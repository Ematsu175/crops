<?php
    require_once('roles.class.php');

    $app = new Roles;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            include('views/roles/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Rol dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar el roles";
                $tipo="danger";
            }
            $roles=$app->readAll();
            include('views/roles/index.php');
            break;

        case 'actualizar':
            $roles=$app->readOne($id);
            include('views/roles/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            //print_r($result);
            if($result){
                $mensaje="Rol actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar el rol";
                $tipo="danger";
            }
            $roles=$app->readAll();
            include('views/roles/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "El rol se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino el rol";
                        $tipo = "danger";
                    }
                }
            }
            $roles=$app->readAll();
            include('views/roles/index.php');
            
            break;
        default:
            $roles=$app->readAll();
            include('views/roles/index.php');
    }

    require_once('views/footer.php');
?>