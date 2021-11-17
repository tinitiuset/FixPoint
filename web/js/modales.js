document.onreadystatechange = function () {
    //  Las ventanas modales aparecen visibles nada más entrar en la página, 
    //  estos if ocultan los modales dependiendo de en cuál te encuentres.
    if (window.location.hash.substring(1) === 'modalIniciar') {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";
    } else if (window.location.hash.substring(1) === 'modal') {
        document.getElementById("modalIniciar").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";

    } else if (window.location.hash.substring(1) === 'modalConfirmarGuia') {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalIniciar").style.display = "none";
    } else {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalIniciar").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";
    }

    if (document.readyState === "complete") {
        if (document.getElementById("unirse") != null && document.getElementById("iniciarSesion") != null) {
            // MODAL CREAR SESIÓN (variables)
            let txtCrearSesion = document.getElementById("unirse");
            let iniciarSesion_txtCrear = document.getElementById("iniciarSesion_txtCrear");
            let modalCrearSesion = document.getElementById("modal");
            let btnCerrarModal = document.getElementById("cerrarCrear");

            txtCrearSesion.addEventListener("click", spawn);
            iniciarSesion_txtCrear.addEventListener("click", spawn);

            // MODAL INICIAR SESIÓN (variables)
            let txtIniciarSesion = document.getElementById("iniciarSesion");
            let iconIniciarSesion = document.getElementById("iconIniciarSesion");
            let crearSesion_txtIniciar = document.getElementById("crearSesion_txtIniciar");
            let modalIniciarSesion = document.getElementById("modalIniciar");
            let imgUsuarioLogueado = document.getElementById("imgUsuarioLogueado");
            let btnCerrarModalSesion = document.getElementsByClassName("cerrar")[1];
            
            txtIniciarSesion.addEventListener("click", spawnIniciar);
            iconIniciarSesion.addEventListener("click", spawnIniciar);
            crearSesion_txtIniciar.addEventListener("click", spawnIniciar);

            //  Función para mostrar el modal "crear sesión"
            function spawn()
            {
                modalCrearSesion.style.display = "block";
                document.querySelector("body").style.overflow = 'hidden';   // Evita que se pueda scrollear el index con el modal abierto
                if (modalIniciarSesion.style.display === "block") {
                    modalIniciarSesion.style.display = "none"
                }
            }
            // CERRAR MODAL
            btnCerrarModal.onclick = function () {

                modalCrearSesion.style.display = "none";
                document.querySelector("body").style.overflow = 'visible';
            }

            //  Función para mostrar el modal "iniciar sesión"
            function spawnIniciar()
            {
                console.log("yay");
                console.log(window.location.hash.substring(1).toString);
                modalIniciarSesion.style.display = "block";
                document.querySelector("body").style.overflow = 'hidden';   // Evita que se pueda scrollear el index con el modal abierto

                if (modalCrearSesion.style.display === "block") {
                    modalCrearSesion.style.display = "none"
                }
            }
            // CERRAR MODAL
            btnCerrarModalSesion.onclick = function () {
                document.getElementById("loginErrorMessage").textContent = "";//cuando cerramos el modal, vaciamos el mensaje
                modalIniciarSesion.style.display = "none";
                document.querySelector("body").style.overflow = 'visible';
            }
        }
        // MODAL CONFIRMAR GUÍA
        let botonAceptarGuia = document.getElementById("botonAceptar");
        let botonCancelarPaso = document.getElementById("btn-cancelarGuia");
        let modalConfirmarGuia = document.getElementById("modalConfirmarGuia");

        //  Añade el evento al botón únicamente si estamos en la sección en la que aparece,
        //  de lo contrario daría error porque no existe.
        if (window.location.href.search('guiaDespiecePaso.php') > 0) {
            botonAceptarGuia.addEventListener("click", spawnConfirmar);

            //  Función para mostrar el modal "confirmar guía"
            function spawnConfirmar()
            {
                modalConfirmarGuia.style.display = "block";
                document.querySelector("body").style.overflow = 'hidden';   // Evita que se pueda scrollear el index con el modal abierto

            }
            // CERRAR MODAL
            botonCancelarPaso.onclick = function () {
                modalConfirmarGuia.style.display = "none";
                document.querySelector("body").style.overflow = 'visible';
            }
        }
    }
}