<?php 
    

use App\Propiedad;


    
if($_SERVER['SCRIPT_NAME'] === '/anuncios.php' ){
    $propiedades = Propiedad::all();
} else {
    $propiedades = Propiedad::get(3);
}
?>



<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
        <picture>
            <img src="/imagenes/<?php echo $propiedad->getImagen(); ?>" alt="anuncio" loading="lazy">
        </picture>
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->getTitulo(); ?></h3>
            <p><?php echo $propiedad->getDescripcion(); ?></p>
            <p class="precio">$<?php echo $propiedad->getPrecio(); ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad->getWc(); ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_estacionamiento.svg"
                        alt="icono_estacionamiento">
                    <p><?php echo $propiedad->getEstacionamiento(); ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="/build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                    <p><?php echo $propiedad->getHabitaciones(); ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad->getId(); ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div>
        <!-- Contenido Anuncio -->
    </div>
    <!-- anuncio -->
    <?php endforeach; ?>
</div>
<!-- contenedor de anuncio -->