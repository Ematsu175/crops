<?php 
    require_once('../sistema.class.php');
    class Empleado extends Sistema{
        
        function create($data){  
            print_r($data);
            //die();         
            $this->conexion();
            $rol=$data['rol'];
            //print_r($rol);
            $data=$data['data'];
            //print_r($data);
            
            //marcar al menos dos roles
            $this->con->beginTransaction();
            try {
                $sql="insert into empleado(primer_apellido,segundo_apellido, nombre, rfc, id_usuario) 
                      values (:primer_apellido, :segundo_apellido, :nombre, :rfc, :id_usuario);";
                $insertar=$this->con->prepare($sql);
                $insertar->bindParam(':correo',$data['correo'],PDO::PARAM_STR);
                $insertar->bindParam(':contrasena',$data['contrasena'],PDO::PARAM_STR);
                $insertar->execute();
                $sql="select id_usuario from usuario where correo=:correo;";
                $consulta = $this->con->prepare($sql);
                $consulta->bindParam('correo', $data['correo'], PDO::PARAM_STR);
                $consulta->execute();
                $datos=$consulta->fetch(PDO::FETCH_ASSOC);
                $id_usuario = (isset($datos['id_usuario']))? $datos['id_usuario'] :null;
                if(!is_null($id_usuario)){
                    foreach($rol as $r => $k){
                        //echo($k); //antes de hacer el isnert hayq ue saber que se esta recuperando
                        //print($rol);
                        //print_r($r);
                        $sql = "insert into usuario_rol(id_usuario, id_rol) 
                                values (:id_usuario, :id_rol)";
                        $insertar_usuario_rol=$this->con->prepare($sql);
                        $insertar_usuario_rol->bindParam('id_usuario', $id_usuario, PDO::PARAM_INT);
                        $insertar_usuario_rol->bindParam('id_rol', $r, PDO::PARAM_INT);
                        $insertar_usuario_rol->execute();
                    }
                    $this->con->commit();
                    return $insertar->rowCount();
                        
                }
                
            } catch (Exception $e) {
                $this->con->rollBack();
            }
            
            return false;
        }

        function update(){

        }
        function delete(){

        }
        function readOne($id){
            $this->conexion();
            $result=[];
            $consulta='select * from empleado where id_empleado=:id_empleado;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam('id_empleado', $id, PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;

        }
        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select * from empleado;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>