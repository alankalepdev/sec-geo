<?php
$pagina        = '';
$titulo_pagina = 'Página no encontrada';
$subtitulo     = 'La página que buscas no existe o cambió de dirección.';
require __DIR__ . '/../includes/header.php';
?>

<section class="sec-section">
    <div class="container sec-center">
        <span class="sec-eyebrow">Error 404</span>
        <h2 class="sec-title">No encontramos esta página</h2>
        <p class="sec-lead">Puedes volver al inicio o revisar nuestras soluciones.</p>
        <a class="sec-btn" href="<?= url() ?>">Ir al inicio</a>
        <a class="sec-btn sec-btn-outline" href="<?= url('soluciones') ?>">Ver soluciones</a>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
