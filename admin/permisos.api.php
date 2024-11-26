<?php
    require_once('permisos.class.php');
    header("Content-type: application/json; charset=utf-8");
    $app = new Permisos;
    //$app->checkRol('Administrador');
    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $accion=$_SERVER['REQUEST_METHOD'];
    $id = (isset($_GET['id']))?$_GET['id']:null;
    $data=[];
    switch($accion){

        case 'POST':
            $datos=$_POST;
            if(!is_null($id) && is_numeric($id)){
                $result = $app->update($id, $datos);
            } else {
                $result = $app->create($datos);
            }
            if($resultado == 1){
                $data['mensaje']="El permiso se ha guardado correctamente";
            } else{
                $data['mensaje']="Ocurrio algun error con el servicio";
            }
            
            break;
        

        case 'DELETE':           
            if (!is_null($id)) {
                if(is_numeric($id)){
                    $resultado = $app->delete($id);
                    if ($resultado) {
                        $mensaje = "El permiso se elimino correctamente";
                        
                    } else {
                        $mensaje = "Error no se elimino el permiso";
                        
                    }
                }
            }
            $data['mensaje']=$mensaje;
            
            break;
        
        default:
            if(!is_null($id) && is_numeric($id)){
                $permisos=$app->readOne($id);
            } else {
                $permisos=$app->readAll();
            }
            
            $data=$permisos;

    }

    echo json_encode($data);

?>