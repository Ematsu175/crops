<?php require('views/header/header_administrador.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Invernadero </h1>
<form method="post" action="roles.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="rol" class="form-label">Nombre del Rol</label>
        <input type="text" class="form-control" name="data[rol]" placeholder="Escribe aqui el nombre del rol" 
        value="<?php if(isset($roles['rol'])):echo($roles['rol']);endif; ?>" />
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>