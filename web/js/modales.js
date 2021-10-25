document.onreadystatechange = function () {
    if(window.location.hash.substring(1) === 'modalIniciar') {
        document.getElementById("modal").style.display = "none";
    } else if (window.location.hash.substring(1) === 'modal') {
        document.getElementById("modalIniciar").style.display = "none";
    }
    else {
        document.getElementById("modal").style.display = "none";
        document.getElementById("modalIniciar").style.display = "none";
    }
    if (document.readyState == "complete") {
        let txtCrearSesion = document.getElementById("unirse");
        let modalCrearSesion = document.getElementById("modal");
        let btnCerrarModal = document.getElementsByClassName("cerrar")[0];

        txtCrearSesion.onclick = function spawn() {
            modalCrearSesion.style.display = "block";
        }

        // CERRAR MODAL
        btnCerrarModal.onclick = function () {
            modalCrearSesion.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modalCrearSesion) {
                modalCrearSesion.style.display = "none";
            }
        }

        let txtIniciarSesion = document.getElementById("iniciarSesion");
        let modalIniciarSesion = document.getElementById("modalIniciar");
        let btnCerrarModalSesion = document.getElementsByClassName("cerrar")[1];

        txtIniciarSesion.onclick = function spawn() {
            console.log("yay")
            modalIniciarSesion.style.display = "block";
        }

        // CERRAR MODAL
        btnCerrarModalSesion.onclick = function () {
            modalIniciarSesion.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modalIniciarSesion) {
                modalIniciarSesion.style.display = "none";
            }
        }
    }
}
