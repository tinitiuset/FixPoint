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
  
})

var imagenes = [];
var textoH2 = ["¿Qué es FixPoint?","¿Qué es una biblioteca de herramientas?","¿Cuál es el objetivo de FixPoint?"];
var texto = [
"FixPoint es una iniciativa circular sostenible, que busca provocar un cambio en el sistema de sobreproducción, luchando por una economía circular con nuestra biblioteca de herramientas.",
"FixPoint es una biblioteca como otra cualquiera. Te conviertes en mienbro y después puedes tomar prestadas las herramientas.",
"Promover una ciudad más sostenible, mediante el intercambio de herramientas y conocimientos, para alargar la vida útil de las cosas. Puedes ser parte de ésta iniciativa haciendo donación de material a nuestra Biblioteca de herramientas."
];
   
imagenes[0] = '../web/img/back01.jpg';
imagenes[1] = '../web/img/back02.jpg';
imagenes[2] = '../web/img/back03.jpg';

var indexImg = 0;

function cambioImagen(event) {
    if (indexImg == 0 && event.currentTarget.direction == -1) {
        indexImg = imagenes.length-1;
        
    }
    else if (indexImg == imagenes.length-1 && event.currentTarget.direction == 1) {
        indexImg = 0;
    }
    else {
        indexImg+=event.currentTarget.direction;
    }
    document.getElementById("slider").src = imagenes[indexImg];
    document.getElementById("titulo").innerHTML = textoH2[indexImg];
    document.getElementById("parrafo").innerHTML = texto[indexImg];
    if (indexImg == 2) {
        document.getElementById("btnDonar").style.display = "inline-block";
    } else {
        document.getElementById("btnDonar").style.display = "none";
    }
}




