<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad"
        value="<?php echo s($propiedad->getTitulo()); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="precio" placeholder="Precio Propiedad"
        value="<?php echo s($propiedad->getPrecio()); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">
    <?php if($propiedad->getImagen()): ?>
    <img src="/imagenes/<?php echo $propiedad->getImagen() ?>" class="imagen-small">
    <?php endif; ?>
    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->getDescripcion()); ?></textarea>
</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9"
        value="<?php echo s($propiedad->getHabitaciones()); ?>">


    <label for="wc">Baños</label>
    <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="9"
        value="<?php echo s($propiedad->getWc()); ?>">

    <label for="estacionamiento">Estacionamientos</label>
    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 1" min="1" max="9"
        value="<?php echo s($propiedad->getEstacionamiento()); ?>">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="id_vendedor" id="vendedor">
        <option selected disabled>-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
        <option <?php echo $propiedad->getIdVendedor() === $vendedor->getId() ? 'selected':'' ?>
            value="<?php echo s($vendedor->getId()); ?>">
            <?php echo s($vendedor->getNombre())." ".s($vendedor->getApellido()); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>