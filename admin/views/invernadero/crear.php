<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nuevo');else: echo('Modificar');endif; ?> Invernadero </h1>
<form method="post" action="invernadero.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="invernadero" class="form-label">Nombre del Invernadero</label>
        <input type="text" class="form-control" name="data[invernadero]" placeholder="Escribe aqui el nombre" 
        value="<?php if(isset($invernaderos['invernadero'])):echo($invernaderos['invernadero']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="latitud" class="form-label">Latitud</label>
        <input type="text" class="form-control" name="data[latitud]" placeholder="Escribe aqui la latitud" 
        value="<?php if(isset($invernaderos['latitud'])):echo($invernaderos['latitud']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="longitud" class="form-label">Longitud</label>
        <input type="text" class="form-control" name="data[longitud]" placeholder="Escribe aqui la longitud" 
        value="<?php if(isset($invernaderos['longitud'])):echo($invernaderos['longitud']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="area" class="form-label">Area del invernadero en m<sup>2</sup></label>
        <input type="number" class="form-control" name="data[area]" placeholder="Escribe aqui la medida" 
        value="<?php if(isset($invernaderos['area'])):echo($invernaderos['area']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" name="data[fecha_creacion]" placeholder="Escribe aqui la fecha" 
        value="<?php if(isset($invernaderos['fecha_creacion'])):echo($invernaderos['fecha_creacion']);endif; ?>" />
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>