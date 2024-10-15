<?php
    require_once('invernadero.class.php');
    $app = new Invernadero;
    $app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    switch($accion){
        case 'crear':
            include('views/invernadero/crear.php');
            break;
        case 'nuevo':
            $data=$_POST['data'];
            $resultado=$app->create($data);
            if($resultado){
                $mensaje="Invernadero dado de alta correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error al momento de agregar el invernadero";
                $tipo="danger";
            }
            $invernaderos=$app->readAll();
            include('views/invernadero/index.php');
            break;

        case 'actualizar':
            $invernaderos=$app->readOne($id);
            include('views/invernadero/crear.php');
            break;
        
        case 'modificar':
            $data=$_POST['data'];
            $result = $app->update($id,$data);
            //print_r($result);
            if($result){
                $mensaje="Invernadero actualizado correctamente";
                $tipo="success";

            } else {
                $mensaje="Hubo un error no se pudo actualizar el invernadero";
                $tipo="danger";
            }
            $invernaderos=$app->readAll();
            include('views/invernadero/index.php');
            break;

        case 'eliminar':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "El invernadero se elimino correctamente";
                        $tipo = "success";
                    } else {
                        $mensaje = "Error no se elimino el invernadero";
                        $tipo = "danger";
                    }
                }
            }
            $invernaderos=$app->readAll();
            include('views/invernadero/index.php');
            
            break;
        default:
            $invernaderos=$app->readAll();
            include('views/invernadero/index.php');
    }
?>