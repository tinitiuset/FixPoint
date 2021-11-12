let index = 0;

let slides = [];

slides[0] = {
    imagen: './img/back01.jpg',
    titulo: '¿Qué es FixPoint?',
    texto:'FixPoint es una iniciativa que busca luchar por una economía circular con nuestra <span class=\"bold\">biblioteca de herramientas</span>.',
};

slides[1] = {
    imagen: './img/back02.jpg',
    titulo: '¿Qué es una biblioteca de herramientas?',
    texto:'FixPoint es una biblioteca como otra cualquiera. Hazte miembro y alquila las herramientas que necesites.',
};

slides[2] = {
    imagen: './img/back03.jpg',
    titulo: '¿Cuál es el objetivo de FixPoint?',
    texto:'Alargar la vida útil de las cosas. Puedes colaborar con esta iniciativa donando tus viejas herramientas.',
};

function cambioImagen(event) {
    if (index === 0 && event.currentTarget.direction === -1) {
        index = slides.length-1;
        
    }
    else if (index === slides.length-1 && event.currentTarget.direction === 1) {
        index = 0;
    }
    else {
        index+=event.currentTarget.direction;
    }
    document.getElementById("slider").src = slides[index].imagen;
    document.getElementById("titulo").innerHTML = slides[index].titulo;
    document.getElementById("parrafo").innerHTML = slides[index].texto;
    if (index === 2) {
        document.getElementById("btnDonar").style.display = "inline-block";
    } else {
        document.getElementById("btnDonar").style.display = "none";
    }
}

window.addEventListener('load', function() {

    /*function cambiarImagenes() {
        document.slider.src = imagenes [indexImg];

        if (indexImg < 2) {
            indexImg++;
        } else {
            indexImg = 0;
        }
    }
    setInterval(cambiarImagenes, 3000);*/ //Para que cambie automático
    document.getElementById("back").direction=-1;
    document.getElementById("next").direction=1;

    document.getElementById("next").onclick = cambioImagen;
    document.getElementById('back').onclick = cambioImagen;

});