document.onreadystatechange = function () {
    if (window.location.hash.substring(1) === 'modalIniciar') {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";
    } if (window.location.hash.substring(1) === 'modal') {
        document.getElementById("modalIniciar").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";

    } if (window.location.hash.substring(1) === 'modalConfirmarGuia') {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalIniciar").style.display = "none";
    } else {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalIniciar").style.display = "none";
        document.getElementById("modalConfirmarGuia").style.display = "none";
    }

    if (document.readyState === "complete") {
        if (document.getElementById("unirse") != null && document.getElementById("iniciarSesion") != null) {
            // MODAL CREAR SESIÓN
            let txtCrearSesion = document.getElementById("unirse");
            let iniciarSesion_txtCrear = document.getElementById("iniciarSesion_txtCrear");
            let modalCrearSesion = document.getElementById("modal");
            let btnCerrarModal = document.getElementById("cerrarCrear");

            // MODAL INICIAR SESIÓN
            let txtIniciarSesion = document.getElementById("iniciarSesion");
            let iconIniciarSesion = document.getElementById("iconIniciarSesion");
            let crearSesion_txtIniciar = document.getElementById("crearSesion_txtIniciar");
            let modalIniciarSesion = document.getElementById("modalIniciar");
            let imgUsuarioLogueado = document.getElementById("imgUsuarioLogueado");
            let btnCerrarModalSesion = document.getElementsByClassName("cerrar")[1];

            txtCrearSesion.addEventListener("click", spawn);
            iniciarSesion_txtCrear.addEventListener("click", spawn);
            txtIniciarSesion.addEventListener("click", spawnIniciar);
            iconIniciarSesion.addEventListener("click", spawnIniciar);
            crearSesion_txtIniciar.addEventListener("click", spawnIniciar);

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
                modalIniciarSesion.style.display = "none";
                document.querySelector("body").style.overflow = 'visible';
            }
        }
        // MODAL CONFIRMAR GUÍA
        let botonAceptarGuia = document.getElementById("botonAceptar");
        let botonCancelarPaso = document.getElementById("btn-cancelarGuia");
        let modalConfirmarGuia = document.getElementById("modalConfirmarGuia");
        if (window.location.href.search('guiaDespiecePaso.php')) {
            console.log("funciona");
            botonAceptarGuia.addEventListener("click", spawnConfirmar);

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