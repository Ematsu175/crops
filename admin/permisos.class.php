<?php
    require_once('../sistema.class.php');

    class Permisos extends Sistema{
        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into permiso(permiso) 
                    values (:permiso);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':permiso',$data['permiso'],PDO::PARAM_STR);
            $insertar->execute();
            $result = $insertar->rowCount();
            
        
            return $result;
        }

        function update($id, $data){
            $this->conexion();
            $result=[];
            $sql = 'update permiso set permiso=:permiso 
                    where id_permiso=:id_permiso';
            $modificar=$this->con->prepare($sql);
            $modificar->bindParam(':permiso',$data['permiso'],PDO::PARAM_STR);
            $modificar->bindParam(':id_permiso',$id,PDO::PARAM_INT);
            $modificar->execute();
            $result=$modificar->rowCount();

            return $result;
        }

        function delete($id){          
            $this->conexion();
            $result=[];
            $sql = "delete from permiso where id_permiso=:id_permiso;";
            $borrar=$this->con->prepare($sql);
            $borrar->bindParam(':id_permiso',$id,PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
            return $result;
        }

        function readOne($id){
            $this->conexion();
            $result=[];
            $consulta='select * from permiso where id_permiso=:id_permiso;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_permiso",$id,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select * from permiso';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>