var txtCrearSesion = document.getElementById("login");
var modal = document.getElementById("modal");
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