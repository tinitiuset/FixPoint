window.addEventListener('load', function() {
    var imagenes = [];

    imagenes[0] = '../web/img/back01.jpg"';
    imagenes[1] = '../web/img/back02.jpg';
    imagenes[2] = '../web/img/back03.jpg';

    var indexImg = 0;

    function cambiarImagenes() {
        document.slider.src = imagenes [indexImg];

        if (indexImg < 2) {
            indexImg++;
        } else {
            indexImg = 0;
        }
    }

    setInterval(cambiarImagenes, 2000);
})