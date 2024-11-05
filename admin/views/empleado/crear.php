<?php require('views/header/header_administrador.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Empleado </h1>
<form method="post" enctype="multipart/form-data" action="empleado.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Primer Apellido</label>
        <input type="text" class="form-control" name="data[primer_apellido]" placeholder="Escribe aqui el primer apellido" 
        value="<?php if(isset($empleados['primer_apellido'])):echo($empleados['primer_apellido']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Segundo Apellido</label>
        <input type="text" class="form-control" name="data[segundo_apellido]" placeholder="Escribe aqui el segundo apellido" 
        value="<?php if(isset($empleados['segundo_apellido'])):echo($empleados['segundo_apellido']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="data[nombre]" placeholder="Escribe aqui el nombre" 
        value="<?php if(isset($empleados['nombre'])):echo($empleados['nombre']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="rfc" class="form-label">RFC</label>
        <input type="text" class="form-control" name="data[rfc]" placeholder="Escribe aqui el rfc" 
        value="<?php if(isset($empleados['rfc'])):echo($empleados['rfc']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="" >Usuario</label>
        <select name="data[id_usuario]" id=""  class="form-select">
            <?php foreach($usuarios as $usuario): ?>
            <?php 
                $selected="";
                if($empleados['id_usuario'] == $usuario['id_usuario']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($usuario['id_usuario']); ?>" <?php echo($selected); ?> ><?php echo($usuario['correo']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="fotografia" class="form-label">fotografia</label>
        <input type="file" class="form-control" name="fotografia" placeholder="Coloca la fotografia"
        value="<?php if(isset($empleados['fotografia'])):echo($empleados['fotografia']);endif; ?>"/>
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>