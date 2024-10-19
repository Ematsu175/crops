<?php 
    require_once('../sistema.class.php');
    

    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    $app = new Sistema;
    switch($accion){
        case 'login':
            $correo = $_POST['data']['correo'];
            $contrasena = $_POST['data']['contrasena'];
            //echo($app->login($correo, $contrasena));
            if($app->login($correo, $contrasena)){
                $mensaje = "Bienvenido al sistema";
                $tipo = "success";
                $app->checkRol('Administrador');
                require_once('views/header/header_administrador.php');
                $app->alerta($tipo, $mensaje);
                //plantillas personalizadas de bienvenida
            } else {
                $mensaje = "Correo o contraseña no validos <a href='login.php'>[Presione aqui para volver a intentar.]</a>";
                $tipo = "danger";
                require_once('views/header.php');
                $app->alerta($tipo, $mensaje);

            }
            die();
        case 'logout':
            $app->logout();
            break;
        default:
            include('views/login/index.php');
            break;

    }
    require_once('views/footer.php');

    

?>