window.addEventListener('load', function() {
   
   /* var indexImg = 0;
    
    function cambiarImagenes() {
        document.slider.src = imagenes [indexImg];

        if (indexImg < 2) {
            indexImg++;
        } else {
            indexImg = 0;
        }
    }*/
    //setInterval(cambiarImagenes, 3000); Para que cambie automático
document.getElementById("back").direction=-1;
document.getElementById("next").direction=1;

document.getElementById("next").onclick = cambioImagen;
document.getElementById('back').onclick = cambioImagen;

})


var imagenes = [];
    
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
    document.slider.src = imagenes [indexImg];
}

