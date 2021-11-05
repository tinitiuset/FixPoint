
function logoutck() {
    var r = confirm("¿Estas seguro?");
    if (r) {
        window.location.href = 'logout.php'
    }
}