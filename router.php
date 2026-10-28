<?php
/**
 * Router para el servidor integrado de PHP (desarrollo local):
 *   php -S 127.0.0.1:8765 router.php
 * En producción con Apache se usa .htaccess.
 */
$ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Bloquear carpetas internas
if (preg_match('#^/(includes|pages)(/|$)|^/(routes|router)\.php$#', $ruta)) {
    http_response_code(403);
    exit('Acceso denegado');
}

// Archivos estáticos existentes: que los sirva el servidor de PHP
$archivo = __DIR__ . $ruta;
if ($ruta !== '/' && is_file($archivo) && pathinfo($archivo, PATHINFO_EXTENSION) !== 'php') {
    return false;
}

require __DIR__ . '/index.php';
