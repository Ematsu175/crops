<?php 
    require_once('../sistema.class.php');
    

    $accion = (isset($_GET['accion']))?$_GET['accion']:null;
    $id = (isset($_GET['id']))?$_GET['id']:null;

    $app = new Sistema;
    switch($accion){
        case 'login':
            $correo = $_POST['data']['correo'];
            $contrasena = $_POST['data']['contrasena'];
            echo($app->login($correo, $contrasena));
            if($app->login($correo, $contrasena)){
                echo("Acceso correcto");
                echo('<pre>');
                print_r($_SESSION);
            } else {
                echo("No se pudo ingresar");
                print_r($_SESSION);
            }
            die();
        case 'logout':
            $app->logout();
            break;
        default:
            include('views/login/index.php');
            break;

    }

    

?>