<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Usuario</h1>
<form method="post" action="usuario.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="correo" class="form-label">Correo</label>
        <input type="text" class="form-control" name="data[correo]" placeholder="Escribe aqui el correo del usuario" 
        value="<?php if(isset($usuario['correo'])):echo($usuario['correo']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="data[contrasena]" placeholder="Escribe aqui la contraseña" 
        value="<?php if(isset($usuario['contrasena'])):echo($usuario['contrasena']);endif; ?>" />
    </div>
    
    <?php foreach($roles as $rol):?>
    <div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="rol[<?php echo($rol['id_rol']);?>]">
            <label class="form-check-label" for="flexSwitchCheckChecked"><?php echo($rol['rol']);?></label>
        </div>
    </div>
    <?php endforeach;?>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>