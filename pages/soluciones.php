<?php
$pagina        = 'soluciones';
$titulo_pagina = 'Soluciones';
$subtitulo     = 'Servicios de especialidad y consultoría en geotecnia, geología, hidrología y geomecánica minera.';
$subheader_img = $galeria_dir . 'proyecto-16.jpg';
require __DIR__ . '/../includes/header.php';
?>

<!-- Servicios -->
<section class="sec-section">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Nuestros servicios</span>
            <h2 class="sec-title">Soluciones técnicas de principio a fin</h2>
            <p>Para minería subterránea y a cielo abierto, con los más altos estándares de calidad y seguridad.</p>
        </div>
        <div class="sec-grid sec-grid-3">
            <?php foreach ($servicios as $i => $s): ?>
                <article class="sec-card">
                    <span class="sec-card-num"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    <i class="sec-card-icon <?= e($s['icono']) ?>"></i>
                    <h3><?= e($s['titulo']) ?></h3>
                    <p><?= e($s['texto']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Experiencia -->
<section class="sec-section sec-bg-light" id="experiencia">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Experiencia</span>
            <h2 class="sec-title">Empresa geólogo-geomecánica con amplia experiencia en:</h2>
        </div>
        <ol class="sec-experience">
            <?php foreach ($experiencia as $item): ?>
                <li><?= e($item) ?></li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<!-- Certificaciones -->
<section class="sec-section sec-bg-navy">
    <div class="container sec-grid sec-grid-2 sec-align-center">
        <div>
            <span class="sec-eyebrow">Equipo y certificaciones</span>
            <h2 class="sec-title">Un equipo multidisciplinario certificado</h2>
            <p class="sec-lead"><?= e($certificaciones) ?></p>
        </div>
        <ul class="sec-badges">
            <?php foreach ($normas as $n): ?>
                <li><?= e($n) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php include __DIR__ . '/../includes/cta.php'; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
