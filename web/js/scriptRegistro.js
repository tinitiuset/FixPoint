document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("formularioRegistro").addEventListener('submit', validarFormulario);
});

function validarFormulario(evento) {
    /*Para que el formulario no haga el submit hasta que yo quiera*/
    evento.preventDefault();


    if (validarDni(document.getElementsByName('dni')[0].value)
        && validarApellidos(document.getElementsByName('apellidos')[0].value)
        && validarNombre(document.getElementsByName('nombre')[0].value)
        && validarEmail(document.getElementsByName('email')[0].value)
        && comprobarPasswords(document.getElementsByName('password')[0].value,
            document.getElementsByName('passwordConfirm')[0].value)
    ) {

        /*Submiteamos el formulario*/
        this.submit();

        /*Este mensaje no sale por el submit de cuando es correcto*/
        var mensaje = 'Usuario registrado correctamente';



    } else {


        var mensaje = '';

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
        if (!comprobarPasswords(document.getElementsByName('password')[0].value,
            document.getElementsByName('passwordConfirm')[0].value)) {
            mensaje += '- Las contraseñas no coinciden';
        }

    }
    let element = document.getElementById('alertwarning');
    element.innerHTML = mensaje;
    element.style.visibility = 'visible';

}

function comprobarPasswords(pass, passConfirm) {
    if (pass == passConfirm)
        return true;
    else
        return false

}

function validarEmail(valor) {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor)) {
        return true;

    } else {
        return false;

    }
}

function validarDni(dni) {
    var numero = dni.substring(0, (dni.length - 1));
    var letter = dni.charAt(dni.length - 1);
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
function validarNombre(nombre) {
    if (validarSoloLetras(nombre)) {
        if (nombre.length > 1 && nombre.length < 10) {
            return true;
        } else {
            return false;
        }
    }
    return false;

}

function validarApellidos(apellidos) {
    if (validarSoloLetras(apellidos)) {
        if (apellidos.length > 4 && apellidos.length < 30) {
            return true;
        } else {
            return false;
        }
    }
    return false;

}

function validarSoloLetras(texto) {

    if (!/^[a-zA-Z]*$/g.test(texto)) {
        /*alert("Invalid characters");*/
        return false;
    } else {
        return true;
    }
}