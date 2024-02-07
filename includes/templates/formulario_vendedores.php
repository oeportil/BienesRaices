<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre Vendedor(a)"
        value="<?php echo s($vendedor->getNombre()); ?>">

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido Vendedor(a)"
        value="<?php echo s($vendedor->getApellido()); ?>">

    <label for="telefono">Telefono</label>
    <input type="tel" id="telefono" name="telefono" placeholder="Telefono Vendedor(a)"
        value="<?php echo s($vendedor->getTelefono()); ?>">
</fieldset>