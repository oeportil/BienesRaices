<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php 
        if($resultado){
            $mensaje=mostrarNotificacion(intval($resultado));
            if($mensaje){ ?>
    <p class="alerta exito"> <?php echo s($mensaje); ?></p>
    <?php 
        }
    }    
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>


    <h2>Propiedades </h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar los Resultados -->
            <?php foreach($propiedades as $propiedad):?>
            <tr>
                <td>
                    <p><?php echo $propiedad->getId(); ?></p>
                </td>
                <td>
                    <p><?php echo $propiedad->getTitulo(); ?></p>
                </td>
                <td><img src="/imagenes/<?php echo $propiedad->getImagen();?>" class="imagen-tabla"></td>
                <td>
                    <p>$ <?php echo $propiedad->getPrecio(); ?></p>
                </td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">

                        <input type="hidden" name="id" value="<?php echo $propiedad->getId(); ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->getId();  ?>"
                        class="boton-amarillo-block">Actualizar</a>
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Mostrar los Resultados -->
            <?php foreach($vendedores as $vendedor):?>
            <tr>
                <td>
                    <p><?php echo $vendedor->getId(); ?></p>
                </td>
                <td>
                    <p><?php echo $vendedor->getNombre(); ?></p>
                </td>
                <td>
                    <p><?php echo $vendedor->getApellido(); ?></p>
                </td>
                <td>
                    <p><?php echo $vendedor->getTelefono(); ?></p>
                </td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="hidden" name="id" value="<?php echo $vendedor->getId(); ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->getId();  ?>"
                        class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>