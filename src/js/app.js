document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkmode();

} );

function darkmode() {
    const DarkModeprefer = window.matchMedia('(prefers-color-scheme: dark)');
    const darkMode = document.querySelector('.darkmode-boton');
    console.log(DarkModeprefer.matches);

    if(DarkModeprefer.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }

    DarkModeprefer.addEventListener('change', function(){
        if(DarkModeprefer.matches){
            document.body.classList.add('dark-mode');
        }else{
            document.body.classList.remove('dark-mode');
        }
    });


    darkMode.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    })
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', () => {
        const navegacion = document.querySelector('.navegacion');
        // if(navegacion.classList.contains('mostrar')) {
        //     navegacion.classList.remove('mostrar');
        // }else{
        //     navegacion.classList.add('mostrar');
        // }
        navegacion.classList.toggle('mostrar');
    });

    //mostrar campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto"]');
    
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto))
}
function mostrarMetodosContacto(e){
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono'){
        contactoDiv.innerHTML = `
        <label for="telefono">Numero Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="telefono">

        <p>Elija la fecha y la hora para la llamada</p>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="hora">
        `;
    }else{
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="email">
        `;
    }
}