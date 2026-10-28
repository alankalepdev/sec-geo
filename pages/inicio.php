<?php
$pagina = 'inicio';
require __DIR__ . '/../includes/header.php';
?>

<!-- Presentación -->
<section class="sec-section">
    <div class="container sec-grid sec-grid-2 sec-align-center">
        <div>
            <span class="sec-eyebrow">Nosotros</span>
            <h2 class="sec-title">Especialistas en geotecnia, geología e hidrología</h2>
            <p class="sec-lead"><?= e($nosotros) ?></p>
            <a class="sec-btn" href="<?= url('nosotros') ?>">Conoce más sobre nosotros <i class="icon-right-open-mini"></i></a>
        </div>
        <div class="sec-stats">
            <div class="sec-stat">
                <strong><?= count($servicios) ?></strong>
                <span>Servicios especializados</span>
            </div>
            <div class="sec-stat">
                <strong>24/7</strong>
                <span>Atención al cliente</span>
            </div>
            <div class="sec-stat">
                <strong><?= count($proyectos) ?></strong>
                <span>Líneas de modelado: geotécnico, geológico y hidrológico</span>
            </div>
            <div class="sec-stat">
                <strong><?= count($normas) ?>+</strong>
                <span>Normas: <?= e(implode(', ', $normas)) ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Soluciones -->
<section class="sec-section sec-bg-light">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Soluciones</span>
            <h2 class="sec-title">Lo que hacemos</h2>
            <p>Servicios de ingeniería para minería subterránea y a cielo abierto, del estudio de campo al diseño final.</p>
        </div>
        <div class="sec-grid sec-grid-3">
            <?php foreach (array_slice($servicios, 0, 6) as $s): ?>
                <article class="sec-card">
                    <i class="sec-card-icon <?= e($s['icono']) ?>"></i>
                    <h3><?= e($s['titulo']) ?></h3>
                    <p><?= e($s['texto']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="sec-center">
            <a class="sec-btn sec-btn-outline" href="<?= url('soluciones') ?>">Ver todas las soluciones <i class="icon-right-open-mini"></i></a>
        </div>
    </div>
</section>

<!-- Experiencia -->
<section class="sec-section sec-bg-navy">
    <div class="container sec-grid sec-grid-2 sec-align-center">
        <div class="sec-image-frame">
            <img src="<?= e($galeria_dir) ?>proyecto-02.jpg" alt="Galería subterránea con fortificación de marcos" loading="lazy">
        </div>
        <div>
            <span class="sec-eyebrow">Experiencia</span>
            <h2 class="sec-title">Empresa geólogo-geomecánica con amplia experiencia</h2>
            <ul class="sec-checklist">
                <?php foreach (array_slice($experiencia, 0, 5) as $item): ?>
                    <li><?= e($item) ?></li>
                <?php endforeach; ?>
            </ul>
            <a class="sec-btn" href="<?= url('soluciones#experiencia') ?>">Ver toda la experiencia <i class="icon-right-open-mini"></i></a>
        </div>
    </div>
</section>

<!-- Clientes -->
<section class="sec-section">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Casos</span>
            <h2 class="sec-title">Empresas que confían en nosotros</h2>
            <p>Modelos geotécnicos, geológico-estructurales e hidrológicos para empresas líderes del sector minero.</p>
        </div>
        <ul class="sec-clients">
            <?php foreach ($clientes as $c): ?>
                <li><?= e($c) ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="sec-gallery sec-gallery-teaser">
            <?php foreach (array_slice($galeria, 0, 4) as $g): ?>
                <a href="<?= e($galeria_dir . $g['img']) ?>" class="sec-gallery-item" data-lightbox="inicio" title="<?= e($g['titulo']) ?>">
                    <img src="<?= e($galeria_dir . $g['img']) ?>" alt="<?= e($g['titulo']) ?>" loading="lazy">
                    <span><?= e($g['titulo']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="sec-center">
            <a class="sec-btn sec-btn-outline" href="<?= url('casos') ?>">Ver casos y galería <i class="icon-right-open-mini"></i></a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/cta.php'; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
