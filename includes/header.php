<?php
/**
 * Encabezado común.
 * Variables esperadas antes del include:
 *   $pagina          clave del menú activo (inicio, soluciones, casos, nosotros, contacto)
 *   $titulo_pagina   título para <title> y el subheader (opcional en inicio)
 *   $subtitulo       texto bajo el título del subheader (opcional)
 *   $subheader_img   imagen de fondo del subheader (opcional)
 */
require_once __DIR__ . '/config.php';

$pagina        = $pagina ?? 'inicio';
$es_inicio     = $pagina === 'inicio';
$titulo_pagina = $titulo_pagina ?? '';
$subtitulo     = $subtitulo ?? '';
$subheader_img = $subheader_img ?? $galeria_dir . 'proyecto-15.jpg';
$titulo_head   = $titulo_pagina ? $titulo_pagina . ' | ' . $site['nombre_largo'] : $site['nombre_largo'] . ' | Geotecnia y Geomecánica Minera';

$body_class = $es_inicio
    ? 'home page template-slider'
    : 'page no-content-padding';
?>
<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
    <meta charset="utf-8">
    <title><?= e($titulo_head) ?></title>
    <meta name="description" content="<?= e($site['descripcion']) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1c3b4f">

    <meta property="og:title" content="<?= e($titulo_head) ?>">
    <meta property="og:description" content="<?= e($site['descripcion']) ?>">
    <meta property="og:image" content="<?= asset('assets/images/sec/logo-sec-completo.png') ?>">

    <link rel="icon" type="image/png" href="<?= asset('assets/images/sec/logo-sec-circulo.png') ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap">

    <link rel="stylesheet" href="<?= asset('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/structure.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/transport3.css') ?>">
    <link rel="stylesheet" href="<?= asset('assets/css/sec.css') ?>">
</head>

<body class="<?= $body_class ?> button-flat layout-full-width if-zoom header-transparent header-fw minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-left menu-link-color menuo-right menuo-no-borders footer-copy-center mobile-tb-center mobile-side-slide mobile-mini-mr-ll tablet-sticky mobile-header-mini mobile-sticky">
    <div id="Wrapper">
        <div id="Header_wrapper"<?php if (!$es_inicio): ?> style="background-image:url('<?= e($subheader_img) ?>')"<?php endif; ?>>
            <header id="Header">
                <div id="Top_bar">
                    <div class="container">
                        <div class="column one">
                            <div class="top_bar_left clearfix">
                                <div class="logo">
                                    <a id="logo" class="sec-logo" href="<?= url() ?>" data-padding="20" aria-label="<?= e($site['nombre_largo']) ?>">
                                        <img src="<?= asset('assets/images/sec/logo-sec-circulo.png') ?>" alt="Logo SEC">
                                        <span class="sec-logo-text">
                                            <strong>Servicios de Especialidad</strong>
                                            <small>y Consultorías</small>
                                        </span>
                                    </a>
                                </div>
                                <div class="menu_wrapper">
                                    <nav id="menu">
                                        <ul id="menu-main-menu" class="menu menu-main">
                                            <?php foreach ($menu as $clave => $item): ?>
                                                <li<?= $clave === $pagina ? ' class="current-menu-item"' : '' ?>>
                                                    <a href="<?= e($item['url']) ?>"><span><?= e($item['titulo']) ?></span></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </nav><a class="responsive-menu-toggle" href="#" aria-label="Abrir menú"><i class="icon-menu-fine"></i></a>
                                </div>
                            </div>
                            <div class="top_bar_right">
                                <div class="top_bar_right_wrapper">
                                    <a href="<?= e(tel_link($site['telefonos'][0])) ?>" class="action_button"><i class="icon-phone"></i> <?= e($site['telefonos'][0]) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($es_inicio): ?>
                    <?php include __DIR__ . '/slider.php'; ?>
                <?php endif; ?>
            </header>

            <?php if (!$es_inicio): ?>
                <div id="Subheader">
                    <div class="container">
                        <div class="column one">
                            <h1 class="title"><?= e($titulo_pagina) ?></h1>
                            <?php if ($subtitulo): ?>
                                <p class="sec-subheader-text"><?= e($subtitulo) ?></p>
                            <?php endif; ?>
                            <ul class="sec-breadcrumbs">
                                <li><a href="<?= url() ?>">Inicio</a></li>
                                <li><?= e($titulo_pagina) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div id="Content">
            <div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
