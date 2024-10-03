<?php require('views/header.php'); ?>
<h1> <?php if($accion=="crear"):echo('Nueva');else: echo('Modificar');endif; ?> Sección </h1>
<form method="post" action="seccion.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id='.$id);endif; ?>">
    <div class="mb-3">
        <label for="seccion" class="form-label">Nombre de la sección</label>
        <input type="text" class="form-control" name="data[seccion]" placeholder="Escribe aqui el nombre" 
        value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="area" class="form-label">Area de la sección en m<sup>2</sup></label>
        <input type="number" class="form-control" name="data[area]" placeholder="Escribe aqui la medida" 
        value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif; ?>" />
    </div>
    <div class="mb-3">
        <label for="" >Invernadero</label>
        <select name="data[id_invernadero]" id=""  class="form-select">
            <?php foreach($invernadero as $invernaderos): ?>
            <?php 
                $selected="";
                if($secciones['id_invernadero'] == $invernaderos['id_invernadero']){
                    $selected = "selected";
                }
            ?>
            <option value="<?php echo($invernaderos['id_invernadero']); ?>" <?php echo($selected); ?> ><?php echo($invernaderos['invernadero']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" class="btn btn-success" name="data[enviar]" value="Guardar" />
</form>

<?php require('views/footer.php');?>