<?php
$pagina        = 'nosotros';
$titulo_pagina = 'Nosotros';
$subtitulo     = 'Ingeniería geotécnica con tecnología de punta y talento humano calificado.';
$subheader_img = $galeria_dir . 'proyecto-10.jpg';
require __DIR__ . '/../includes/header.php';
?>

<!-- Quiénes somos -->
<section class="sec-section">
    <div class="container sec-grid sec-grid-2 sec-align-center">
        <div class="sec-image-frame">
            <img src="<?= e($galeria_dir) ?>proyecto-10.jpg" alt="Equipo SEC en inspección de mina a cielo abierto" loading="lazy">
        </div>
        <div>
            <span class="sec-eyebrow">Quiénes somos</span>
            <h2 class="sec-title">Servicios de Especialidad y Consultorías</h2>
            <p class="sec-lead"><?= e($nosotros) ?></p>
        </div>
    </div>
</section>

<!-- Misión y visión -->
<section class="sec-section sec-bg-light">
    <div class="container sec-grid sec-grid-2">
        <article class="sec-card sec-card-lg">
            <i class="sec-card-icon icon-target"></i>
            <h3>Misión</h3>
            <p><?= e($mision) ?></p>
        </article>
        <article class="sec-card sec-card-lg">
            <i class="sec-card-icon icon-eye"></i>
            <h3>Visión</h3>
            <p><?= e($vision) ?></p>
        </article>
    </div>
</section>

<!-- Equipo -->
<section class="sec-section">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Atención</span>
            <h2 class="sec-title">Nuestro equipo</h2>
            <p><?= e($certificaciones) ?></p>
        </div>
        <div class="sec-grid sec-grid-3">
            <?php foreach ($equipo as $persona): ?>
                <article class="sec-team">
                    <i class="icon-user"></i>
                    <h3><?= e($persona['nombre']) ?></h3>
                    <p><?= e($persona['cargo']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <ul class="sec-badges sec-badges-inline">
            <?php foreach ($normas as $n): ?>
                <li><?= e($n) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php include __DIR__ . '/../includes/cta.php'; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
