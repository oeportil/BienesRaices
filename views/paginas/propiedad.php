<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->getTitulo(); ?></h1>
    <picture>
        <img src="imagenes/<?php echo $propiedad->getImagen(); ?>" alt="imagen de la propiedad" loading="lazy">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->getPrecio(); ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->getWc(); ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                <p><?php echo $propiedad->getEstacionamiento(); ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                <p><?php echo $propiedad->getHabitaciones(); ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->getDescripcion(); ?></p>
    </div>
</main>