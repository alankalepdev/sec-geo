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
$titulo_head   = $seo[$pagina]['titulo'] ?? ($titulo_pagina ?: $site['nombre_largo']);
if ($pagina !== 'inicio') {
    $titulo_head .= ' | SEC';
}
$meta_desc     = $seo[$pagina]['descripcion'] ?? $site['descripcion'];
$indexable     = isset($menu[$pagina]);
$canonical     = $indexable ? abs_url($menu[$pagina]['url']) : '';
$og_imagen     = abs_url($es_inicio ? $galeria_dir . 'proyecto-15.jpg' : $subheader_img);

// Datos estructurados (schema.org) del negocio
$schema = [
    '@context'    => 'https://schema.org',
    '@type'       => 'ProfessionalService',
    'name'        => $site['nombre_largo'],
    'alternateName' => $site['nombre'],
    'description' => $site['descripcion'],
    'url'         => abs_url(url()),
    'logo'        => abs_url(asset('assets/images/sec/logo-sec-completo.png')),
    'image'       => abs_url($galeria_dir . 'proyecto-15.jpg'),
    'email'       => $site['email'],
    'telephone'   => '+52' . preg_replace('/\D/', '', $site['whatsapp']),
    'areaServed'  => ['@type' => 'Country', 'name' => 'México'],
    'knowsAbout'  => ['Geomecánica', 'Geotecnia', 'Geología', 'Geohidrología', 'Mecánica de rocas', 'Minería subterránea', 'Minería a cielo abierto'],
    'openingHoursSpecification' => [
        '@type'     => 'OpeningHoursSpecification',
        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        'opens'     => '00:00',
        'closes'    => '23:59',
    ],
];

$body_class = $es_inicio
    ? 'home page template-slider'
    : 'page no-content-padding';
?>
<!DOCTYPE html>
<html lang="es" class="no-js">

<head>
    <meta charset="utf-8">
    <title><?= e($titulo_head) ?></title>
    <meta name="description" content="<?= e($meta_desc) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1c3b4f">
    <?php if ($indexable): ?>
        <meta name="robots" content="index, follow, max-image-preview:large">
        <link rel="canonical" href="<?= e($canonical) ?>">
    <?php else: ?>
        <meta name="robots" content="noindex, follow">
    <?php endif; ?>

    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_MX">
    <meta property="og:site_name" content="<?= e($site['nombre_largo']) ?>">
    <meta property="og:title" content="<?= e($titulo_head) ?>">
    <meta property="og:description" content="<?= e($meta_desc) ?>">
    <meta property="og:image" content="<?= e($og_imagen) ?>">
    <?php if ($indexable): ?>
        <meta property="og:url" content="<?= e($canonical) ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($titulo_head) ?>">
    <meta name="twitter:description" content="<?= e($meta_desc) ?>">
    <meta name="twitter:image" content="<?= e($og_imagen) ?>">

    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>

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
                                    <a href="<?= url('contacto') ?>" class="action_button"><i class="icon-mail"></i> Contáctanos</a>
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
