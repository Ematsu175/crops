<?php
    require_once('../sistema.class.php');

    class Seccion extends Sistema{
        function create($data){
            $this->conexion();
            $result=[];
            $sql="insert into seccion(seccion,area,id_invernadero) 
                    values (:seccion,:area,:id_invernadero);";
            $insertar = $this->con->prepare($sql);
            $insertar->bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
            $insertar->bindParam(':area',$data['area'],PDO::PARAM_INT);
            $insertar->bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
            $insertar->execute();
            $result = $insertar->rowCount();

            return $result;
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
            $consulta='select * from seccion where id_seccion=:id_seccion;';
            $sql = $this->con->prepare($consulta);
            $sql->bindParam("id_seccion",$id,PDO::PARAM_INT);
            $sql->execute();
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        function readAll(){
            $this->conexion();
            $result=[];
            $consulta='select s.*,i.invernadero from seccion s join invernadero i on s.id_invernadero=i.id_invernadero;';
            $sql = $this->con->prepare($consulta);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>