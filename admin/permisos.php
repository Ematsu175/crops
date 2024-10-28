<?php
    require_once('permisos.class.php');

    $app = new Permisos;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            include('views/permisos/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Permiso dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar el permiso";
                $tipo="danger";
            }
            $permisos=$app->readAll();
            include('views/permisos/index.php');
            break;

        case 'actualizar':
            $permisos=$app->readOne($id);
            include('views/permisos/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            //print_r($result);
            if($result){
                $mensaje="Permiso actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar el permiso";
                $tipo="danger";
            }
            $permisos=$app->readAll();
            include('views/permisos/index.php');
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
            $permisos=$app->readAll();
            include('views/permisos/index.php');
            
            break;
        default:
            $permisos=$app->readAll();
            include('views/permisos/index.php');
    }

    require_once('views/footer.php');
?>