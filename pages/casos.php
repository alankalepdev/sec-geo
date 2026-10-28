<?php
$pagina        = 'casos';
$titulo_pagina = 'Casos';
$subtitulo     = 'Proyectos destacados para empresas líderes del sector minero.';
$subheader_img = $galeria_dir . 'proyecto-08.jpg';
require __DIR__ . '/../includes/header.php';
?>

<!-- Proyectos destacados -->
<section class="sec-section">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Proyectos destacados</span>
            <h2 class="sec-title">Modelos que respaldan decisiones mineras</h2>
            <p>Algunos de nuestros clientes son recurrentes gracias a nuestro compromiso con la calidad y el servicio al cliente, que está atento 24/7.</p>
        </div>
        <div class="sec-grid sec-grid-3">
            <?php foreach ($proyectos as $p): ?>
                <article class="sec-case">
                    <h3><?= e($p['titulo']) ?></h3>
                    <p><?= e($p['texto']) ?></p>
                    <ul>
                        <?php foreach ($p['clientes'] as $c): ?>
                            <li><?= e($c) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Galería -->
<section class="sec-section sec-bg-light" id="galeria">
    <div class="container">
        <div class="sec-heading">
            <span class="sec-eyebrow">Galería de proyectos</span>
            <h2 class="sec-title">Nuestro trabajo en campo</h2>
        </div>
        <div class="sec-filters" role="tablist">
            <button type="button" class="is-active" data-filter="*">Todos</button>
            <?php foreach ($galeria_categorias as $clave => $nombre): ?>
                <button type="button" data-filter="<?= e($clave) ?>"><?= e($nombre) ?></button>
            <?php endforeach; ?>
        </div>
        <div class="sec-gallery">
            <?php foreach ($galeria as $g): ?>
                <a href="<?= e($galeria_dir . $g['img']) ?>" class="sec-gallery-item" data-cat="<?= e($g['cat']) ?>" data-lightbox="casos" title="<?= e($g['titulo']) ?>">
                    <img src="<?= e($galeria_dir . $g['img']) ?>" alt="<?= e($g['titulo']) ?>" loading="lazy">
                    <span><?= e($g['titulo']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/cta.php'; ?>

<?php require __DIR__ . '/../includes/footer.php'; ?>
