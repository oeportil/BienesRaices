<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php if ($mensaje) { ?>
        <p class='alerta exito'><?php echo $mensaje; ?></p>
    <?php } ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
    </picture>
    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="nombre" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Informacion sobre la propiedad</legend>
            <label for="opciones">Vende o Compra:</label>
            <select id="opciones" name="tipo" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input required type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="precio">

        </fieldset>
        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Telefono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">E-mail</label>
                <input name="contacto" type="radio" value="email" id="contactar-email" required>
            </div>
            <div id=contacto></div>


        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>