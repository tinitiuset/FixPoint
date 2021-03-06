document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("formularioRegistro").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento)
{
    if (!(validarDni(document.getElementsByName('dni')[0].value)
        && validarApellidos(document.getElementsByName('apellidos')[0].value)
        && validarNombre(document.getElementsByName('nombre')[0].value)
        && validarEmail(document.getElementsByName('email')[0].value)
        && comprobarPasswords(
            document.getElementsByName('password')[0].value,
            document.getElementsByName('passwordConfirm')[0].value
        ))) {
        evento.preventDefault();
        let mensaje = ' ';
        if (!validarDni(document.getElementsByName('dni')[0].value)) {
            mensaje += '- El dni no es correcto';
        }
        if (!validarApellidos(document.getElementsByName('apellidos')[0].value)) {
            mensaje += '- Rellena los apellidos correctamente';
        }
        if (!validarEmail(document.getElementsByName('email')[0].value)) {
            mensaje += '- El email no es correcto';
        }
        if (!validarNombre(document.getElementsByName('nombre')[0].value)) {
            mensaje += '- El nombre no es correcto';
        }
        if (!comprobarPasswords(
            document.getElementsByName('password')[0].value,
            document.getElementsByName('passwordConfirm')[0].value
        )) {
            mensaje += '- Las contraseñas no coinciden';
        }
        /* CREACION DE ELEMENTO CON EL DOM */
        const element = document.getElementById("modalBodyCrear");
        const createDiv = document.createElement("div");
        createDiv.appendChild(document.createTextNode(mensaje));
        createDiv.setAttribute('class', 'alert alert-danger');
        createDiv.setAttribute('id', 'alertwarning');
        createDiv.setAttribute('role', 'alert');
        element.appendChild(createDiv);
    }
}

function comprobarPasswords(pass, passConfirm)
{
    return pass === passConfirm;
}

function validarEmail(valor)
{
    return /^([a-zA-Z0-9_.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor);
}

function validarDni(dni)
{
    let numero = dni.substring(0, (dni.length - 1));
    let letter = dni.charAt(dni.length - 1);
    if (!isNaN(numero)
        && isNaN(letter)
        && numero.toString().length === 8
        && letter.length === 1) {
        let lettersOrder = 'TRWAGMYFPDXBNJZSQVHLCKET';
        if (lettersOrder[numero % 23] === letter.toUpperCase()) {
            return true;
        }
    }
    return false;
}

/* NO UNIFICAMOS LAS DOS SIGUIENTES FUNCIONES AUN QUE SEAN SIMILARES YA QUE QUEREMOS EL MENSAJE DE ERROR DISTINTO
YA QUE CADA CAMPO TIENE TAMAÑOS DISTINTOS EN BBDD*/
function validarNombre(nombre)
{
    if (validarSoloLetras(nombre)) {
        return nombre.length > 1 && nombre.length < 10;
    }
    return false;
}

function validarApellidos(apellidos)
{
    if (validarSoloLetras(apellidos)) {
        return apellidos.length > 1 && apellidos.length < 30;
    }
    return false;
}

function validarSoloLetras(texto)
{
    return /^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/.test(texto);
}