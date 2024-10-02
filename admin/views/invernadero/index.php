<?php require ('views/header.php') ?>
    <h1>Invernaderos</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje); endif; ?>
    <a href="invernadero.php?accion=crear" class="btn btn-success">Nuevo</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Area</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">fecha</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($invernaderos as $invernadero):?>
            <tr>
                <th scope="row"><?php echo $invernadero['id_invernadero']; ?></th>
                <td><?php echo $invernadero['invernadero']; ?></td>
                <td><?php echo $invernadero['area']; ?></td>
                <td><?php echo $invernadero['latitud']; ?></td>
                <td><?php echo $invernadero['longitud']; ?></td>
                <td><?php echo $invernadero['fecha_creacion']; ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <a href="invernadero.php?accion=actualizar&id=<?php echo $invernadero['id_invernadero']; ?>" class="btn btn-warning">Actualizar</a>
                        <a href="invernadero.php?accion=eliminar&id=<?php echo $invernadero['id_invernadero']; ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php require ('views/footer.php') ?>