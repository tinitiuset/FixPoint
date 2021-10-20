var txtIniciarSesion = document.getElementById("iniciarSesion");
var modal = document.getElementById("modalIniciar");
var btnCerrarModal = document.getElementsByClassName("cerrar")[0];

txtCrearSesion.onclick = function spawn() {
    modal.style.display = "block";
}

// CERRAR MODAL
btnCerrarModal.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}