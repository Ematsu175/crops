<?php
    session_start();
    require_once('config.class.php');
    class Sistema{
        var $con;
        function conexion(){
            $this->con = new PDO(SGBD.':host='.DBHOST.';port='.DBPORT.';dbname='.DBNAME.'', DBUSER, DBPASS);
        }

        function alerta($tipo, $mensaje){
            include('views/alert.php');
        }

        function getRol($correo){
            $this->conexion();
            $data = [];
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $sql="select r.rol from usuario u inner join usuario_rol ur on u.id_usuario = ur.id_usuario
                        inner join rol r on ur.id_rol = r.id_rol where u.correo=:correo;";
                $roles = $this->con->prepare($sql);
                $roles->bindParam('correo', $correo, PDO::PARAM_STR);
                $roles->execute();
                $data = $roles->fetchAll(PDO::FETCH_ASSOC);
                $rolesf = [];
                foreach($data as $rol){
                    array_push($rolesf, $rol['rol']);
                }
                $data = $rolesf;

            }
            return $data;
        }

        function getPrivilegios($correo){
            $this->conexion();
            $data = [];
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $sql = "select p.permiso 
                        from usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario 
                        join rol r on ur.id_rol = r.id_rol 
                        join rol_permiso rp on r.id_rol = rp.id_rol 
                        join permiso p on rp.id_permiso = p.id_permiso 
                        where u.correo=:correo;";
                $privilegios =$this->con->prepare($sql);
                $privilegios->bindParam('correo', $correo, PDO::PARAM_STR);
                $privilegios->execute();
                $data = $privilegios->fetchAll(PDO::FETCH_ASSOC);
                $permisos = [];
                foreach($data as $permiso){
                    array_push($permisos, $permiso['permiso']);
                }
                $data = $permisos;
            }
            return $data;
        }

        function login($correo, $contrasena){
            $contrasena = md5($contrasena);
            $acceso = false;
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $this->conexion();
                $sql = 'select * from usuario 
                        where correo=:correo and contrasena=:contrasena;';
                $login = $this->con->prepare($sql);
                $login->bindParam('correo', $correo, PDO::PARAM_STR);
                $login->bindParam('contrasena', $contrasena, PDO::PARAM_STR);
                $login->execute();
                $resultado = $login->fetchAll(PDO::FETCH_ASSOC);
                if(isset($resultado[0])){
                    $acceso = true;
                    $_SESSION['correo'] = $correo;
                    $_SESSION['validado'] = $acceso;
                    $roles = $this->getRol($correo);
                    $privilegios = $this->getPrivilegios($correo);
                    $_SESSION['roles']=$roles;
                    $_SESSION['privilegios']= $privilegios;
                    return $acceso;
                } 
                
            }
            $_SESSION['validado'] = false;
            return $acceso;
        }
        function logout(){
            unset($_SESSION);
            session_destroy();
            $mensaje = "Gracias por utilizar el sistema, se ha cerrado la sesión. <a href='login.php'>[Presione aqí para volver a entrar]</a>";
            $tipo = "success";
            require_once('views/header.php');
            $this->alerta($tipo, $mensaje);
            require_once('views/footer.php');
        }

        function checkRol($rol){
            if(isset($_SESSION['roles'])){
                $roles = $_SESSION['roles'];
                if(!in_array($rol, $roles)){
                    $mensaje = "Error usted no tiene el rol adecuado";
                    $tipo = "danger";
                    require_once('views/header/alert.php');
                    $this->alerta($tipo, $mensaje);
                    die();
                }
                
            } else {
                $mensaje = "Requiere iniciar sesión. <a href='login.php'>[Presione aqí para volver a entrar]</a>";
                $tipo = "danger";
                require_once('views/header.php');
                $this->alerta($tipo, $mensaje);
                require_once('views/footer.php');
                die();
            }
            
        }
    }

?>