<?php
    require_once('../sistema.class.php');

    class Usuario extends Sistema{
        function create($data){
            $this->conexion();
            $result=[];
            $rol = $data['rol'];
            $data = $data['data'];
            print_r($rol);
            print_r($data);
            //marcar al menos dos roles
            $this->con->beginTransaction();
            try {
                $sql="insert into usuario(correo,contrasena) 
                      values (:correo,:contrasena);";
                $insertar = $this->con->prepare($sql);
                $insertar->bindParam(':correo',$data['correo'],PDO::PARAM_STR);
                $insertar->bindParam(':contrasena',$data['contrasena'],PDO::PARAM_STR);
                $insertar->execute();
                $sql = "select id_usuario from usuario where correo=:correo;";
                $consulta = $this->con->prepare($sql);
                $consulta->bindParam('correo', $data['correo'], PDO::PARAM_STR);
                $consulta->execute();
                $datos = $consulta->fetch(PDO::FETCH_ASSOC);
                $id_usuario = (isset($datos['id_usuario']))? $datos['id_usuario'] :null;
                if(!is_null($id_usuario)){
                    foreach($rol as $r => $k){
                        //echo($k); //antes de hacer el isnert hayq ue saber que se esta recuperando
                        //print($rol);
                        //print_r($r);
                        $sql = "insert into usuario_rol(id_usuario, id_rol) 
                                values (:id_usuario, :id_rol)";
                        $insertar_usuario_rol = $this->con->prepare($sql);
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

        function update($id, $data){
            $this->conexion();
            $result=[];
            $sql = 'update seccion set seccion=:seccion, 
                                            area=:area,
                                            id_invernadero=:id_invernadero
                                            where id_seccion=:id_seccion';
            $modificar=$this->con->prepare($sql);
            $modificar->bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
            $modificar->bindParam(':area',$data['area'],PDO::PARAM_INT);
            $modificar->bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
            $modificar->bindParam(':id_seccion',$id,PDO::PARAM_INT);
            $modificar->execute();
            $result=$modificar->rowCount();

            return $result;
        }

        function delete($id){          
            $this->conexion();
            $result=[];
            $sql = "delete from seccion where id_seccion=:id_seccion;";
            $borrar=$this->con->prepare($sql);
            $borrar->bindParam(':id_seccion',$id,PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
            return $result;
        }

        function readOne($id){
            $this->conexion();
            $result=[];
            $consulta='select * from usuario where id_usuario=:id_usuario;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_usuario",$id,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select * from usuario;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAllRoles($id){
            $this->conexion();
            $result=[];
            $consulta="select u.id_usuario,u.correo,r.rol from usuario u inner join usuario_rol ur on u.id_usuario=ur.id_usuario inner join rol r on ur.id_rol=r.id_rol where u.id_usuario=:id_usuario;";
            $sql = $this->con->prepare($consulta);
            $consulta->bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>