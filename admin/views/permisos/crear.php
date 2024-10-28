<?php require('views/header/header_administrador.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Invernadero </h1>
<form method="post" action="permisos.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="permiso" class="form-label">Nombre del Permiso</label>
        <input type="text" class="form-control" name="data[permiso]" placeholder="Escribe aqui el nombre del permiso" 
        value="<?php if(isset($permisos['permiso'])):echo($permisos['permiso']);endif; ?>" />
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>