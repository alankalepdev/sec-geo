<?php
$slides = [
    [
        'img'      => 'proyecto-15.jpg',
        'etiqueta' => 'Geotecnia · Geología · Hidrología',
        'titulo'   => 'Ingeniería geotécnica<br>para la minería',
        'texto'    => 'Desarrollo, diseño y ejecución de proyectos integrales con los más altos estándares de calidad y seguridad.',
        'boton'    => ['Ver soluciones', url('soluciones')],
    ],
    [
        'img'      => 'proyecto-07.jpg',
        'etiqueta' => 'Minería subterránea',
        'titulo'   => 'Geomecánica que<br>sostiene tu operación',
        'texto'    => 'Modelos geomecánicos, fortificación y control de estabilidad desde la prefactibilidad hasta la operación.',
        'boton'    => ['Conoce nuestros casos', url('casos')],
    ],
    [
        'img'      => 'proyecto-16.jpg',
        'etiqueta' => 'Cielo abierto',
        'titulo'   => 'Estabilidad de taludes<br>y modelos hidrológicos',
        'texto'    => 'Atención al cliente 24/7 para empresas líderes del sector minero en México.',
        'boton'    => ['Solicita una cotización', url('contacto')],
    ],
];
?>
<div class="sec-slider" id="sec-slider" aria-roledescription="carrusel">
    <?php foreach ($slides as $i => $s): ?>
        <div class="sec-slide<?= $i === 0 ? ' is-active' : '' ?>" role="group" aria-roledescription="diapositiva" aria-label="<?= $i + 1 ?> de <?= count($slides) ?>">
            <div class="sec-slide-bg" style="background-image:url('<?= e($galeria_dir . $s['img']) ?>')"></div>
            <div class="sec-slide-content container">
                <span class="sec-slide-tag"><?= e($s['etiqueta']) ?></span>
                <h2 class="sec-slide-title"><?= $s['titulo'] ?></h2>
                <p class="sec-slide-text"><?= e($s['texto']) ?></p>
                <a class="sec-btn" href="<?= e($s['boton'][1]) ?>"><?= e($s['boton'][0]) ?> <i class="icon-right-open-mini"></i></a>
            </div>
        </div>
    <?php endforeach; ?>

    <button class="sec-slider-arrow prev" type="button" aria-label="Anterior"><i class="icon-left-open-big"></i></button>
    <button class="sec-slider-arrow next" type="button" aria-label="Siguiente"><i class="icon-right-open-big"></i></button>

    <div class="sec-slider-dots">
        <?php foreach ($slides as $i => $s): ?>
            <button type="button" class="<?= $i === 0 ? 'is-active' : '' ?>" aria-label="Ir a la diapositiva <?= $i + 1 ?>"></button>
        <?php endforeach; ?>
    </div>
</div>
