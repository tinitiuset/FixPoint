 console.log("Ejecutando")
    function cambiarClase(){ /*llamamos a la funcion cambiarclase*/
        let siteNav = document.getElementById('site-nav'); /* Declaramos la variable siteNave*/ 
            siteNav.classList.toggle('site-nav-open'); /**Aqui añadimos la clase que queramos que añada o quite */
        let menuOpen = document.getElementById('menu-toggle');/** unimos el menu open con toggle para que al hacer
        click haga la transformación que pusimos en el css */
            menuOpen.classList.toggle('menu-open');

    }
