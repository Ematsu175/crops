<?php
    require_once('../sistema.class.php');
    use Spipu\Html2Pdf\Html2Pdf;
    use Spipu\Html2Pdf\Exception\Html2PdfException;
    use Spipu\Html2Pdf\Exception\ExceptionFormatter;

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

        function reporte(){
            require_once '../vendor/autoload.php';
            $this->conexion();

            $sql="select * from vista_seccion_cantidadInvernaderos;";
            $consulta=$this->con->prepare($sql);
            $consulta->execute();
            $data=$consulta->fetchAll(PDO::FETCH_ASSOC);
            try {
                include('../lib/phpqrcode/qrlib.php'); 
                $id_factura=rand(1,100);
                $file_name = '../qr/'.$id_factura.'.png';
                QRcode::png('http://localhost:8080/crops/facturas/'.$id_factura, $file_name,2,2,2);
                ob_start();
                $content = ob_get_clean();
                $content = '
                <html>
                    <body>
                        <table align="center">
                            <tr>
                            <th><img src="../images/logocrops.jpg" width=100, height=100 align="center"></th>
                            </tr>
                        </table>
                        <h2>PROYECTO CROPS</h2>
                        <p>Direccion: Avenida San Francisco Javier 9, Edificio Sevilla 2, planta 2ª módulo 30, C.P 41018, Sevilla</p>
                        <h2>Reporte CROPS</h2>
                        
                        <h3>Secciones e invernaderos</h3>
                        <table border="1">
                            <tr>
                            <th>Seccion</th>
                            <th>Número de invernaderos</th>
                            </tr>
                        ';
                        foreach($data as $seccion){
                            $content.='<tr><td>';
                            $content.=$seccion['seccion'];
                            $content.='</td>';
                            $content.='<td>';
                            $content.=$seccion['cantInvernaderos'];
                            $content.='</td></tr>';
                        }
                        $content.='
                        </table>
                        <img src="../qr/'.$id_factura.'.png" width=100, height=100 align="center">
                    </body>
                </html>';
                $html2pdf = new Html2Pdf('P', 'A4', 'fr');
                $html2pdf->setDefaultFont('Arial');
                $html2pdf->writeHTML($content);
                $html2pdf->output('example00.pdf');
            } catch (Html2PdfException $e) {
                $html2pdf->clean();
            
                $formatter = new ExceptionFormatter($e);
                echo $formatter->getHtmlMessage();
            }

        }

        
    }
?>