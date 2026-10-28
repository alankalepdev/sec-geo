<?php
/**
 * Controlador frontal: todas las peticiones llegan aquí
 * (vía .htaccess en Apache o router.php con el servidor de PHP).
 */
require_once __DIR__ . '/includes/config.php';
$rutas = require __DIR__ . '/routes.php';

// Ruta solicitada, relativa a la base del sitio
$ruta = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$ruta = rawurldecode($ruta);
if (strpos($ruta, BASE_URL) === 0) {
    $ruta = substr($ruta, strlen(BASE_URL));
}
$ruta = trim($ruta, '/');

// URLs antiguas con extensión (/soluciones.php, /index.php) → redirección 301 a la URL limpia
if (preg_match('/^(.*?)\.php$/', $ruta, $m)) {
    $limpia = $m[1] === 'index' ? '' : $m[1];
    if (array_key_exists($limpia, $rutas)) {
        $query = $_SERVER['QUERY_STRING'] ?? '';
        header('Location: ' . url($limpia) . ($query !== '' ? '?' . $query : ''), true, 301);
        exit;
    }
}

if (array_key_exists($ruta, $rutas)) {
    require __DIR__ . '/pages/' . $rutas[$ruta];
} else {
    http_response_code(404);
    require __DIR__ . '/pages/404.php';
}
