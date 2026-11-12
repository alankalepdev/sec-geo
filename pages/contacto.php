<?php
session_start();
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/mailer.php';

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

$campos  = ['nombre' => '', 'empresa' => '', 'email' => '', 'telefono' => '', 'servicio' => '', 'mensaje' => ''];
$errores = [];
$estado  = $_GET['enviado'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($campos as $clave => $_) {
        $campos[$clave] = trim((string) ($_POST[$clave] ?? ''));
    }

    // Honeypot anti-spam: los humanos no ven este campo
    $es_bot = !empty($_POST['website']);

    if (!hash_equals($_SESSION['csrf'], (string) ($_POST['csrf'] ?? ''))) {
        $errores['general'] = 'La sesión expiró. Recarga la página e inténtalo de nuevo.';
    }
    // Límite: un envío por minuto por sesión
    if (!$errores && time() - ($_SESSION['ultimo_envio'] ?? 0) < 60) {
        $errores['general'] = 'Ya recibimos un mensaje tuyo hace un momento. Espera un minuto antes de enviar otro.';
    }
    if ($campos['nombre'] === '') {
        $errores['nombre'] = 'Escribe tu nombre.';
    } elseif (mb_strlen($campos['nombre']) > 100) {
        $errores['nombre'] = 'El nombre es demasiado largo.';
    }
    if (!filter_var($campos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Escribe un correo electrónico válido.';
    }
    if ($campos['mensaje'] === '') {
        $errores['mensaje'] = 'Cuéntanos sobre tu proyecto.';
    } elseif (mb_strlen($campos['mensaje']) > 5000) {
        $errores['mensaje'] = 'El mensaje es demasiado largo (máximo 5000 caracteres).';
    }
    if ($campos['servicio'] !== '' && $campos['servicio'] !== 'Otro' && !in_array($campos['servicio'], array_column($servicios, 'titulo'), true)) {
        $campos['servicio'] = 'Otro';
    }

    if (!$errores) {
        // A los bots se les responde como si se hubiera enviado
        if ($es_bot || enviar_contacto($campos)) {
            $_SESSION['ultimo_envio'] = time();
            // Post/Redirect/Get para evitar reenvíos al recargar
            header('Location: ' . url('contacto') . '?enviado=ok#formulario');
            exit;
        }
        // Si falló el envío se vuelve a mostrar el formulario con lo que escribió la persona
        $estado = 'error';
    }
}

$pagina        = 'contacto';
$titulo_pagina = 'Contacto';
$h1            = 'Cotiza tu estudio geomecánico o geotécnico';
$subtitulo     = 'Cuéntanos sobre tu proyecto. Te atendemos 24/7.';
$subheader_img = $galeria_dir . 'proyecto-17.jpg';
require __DIR__ . '/../includes/header.php';
?>

<section class="sec-section">
    <div class="container sec-grid sec-grid-contact">

        <!-- Datos de contacto -->
        <aside class="sec-contact-info">
            <span class="sec-eyebrow">Contacto</span>
            <h2 class="sec-title">Hablemos de tu proyecto</h2>

            <ul class="sec-contact-list">
                <li>
                    <i class="sec-icon-whatsapp"></i>
                    <div><small>WhatsApp</small><a href="<?= e(whatsapp_link($site['whatsapp'])) ?>" target="_blank" rel="noopener"><?= e($site['whatsapp']) ?></a></div>
                </li>
                <li>
                    <i class="icon-mail"></i>
                    <div><small>Correo electrónico</small><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></div>
                </li>
                <li>
                    <i class="icon-clock"></i>
                    <div><small>Horario</small>Atención al cliente 24/7</div>
                </li>
            </ul>
        </aside>

        <!-- Formulario -->
        <div class="sec-form-wrap" id="formulario">
            <?php if ($estado === 'ok'): ?>
                <div class="sec-alert sec-alert-ok">¡Gracias! Recibimos tu mensaje y nos pondremos en contacto contigo a la brevedad.</div>
            <?php elseif ($estado === 'error'): ?>
                <div class="sec-alert sec-alert-error">No pudimos enviar tu mensaje. Escríbenos directamente a <a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a>.</div>
            <?php endif; ?>
            <?php if (!empty($errores['general'])): ?>
                <div class="sec-alert sec-alert-error"><?= e($errores['general']) ?></div>
            <?php endif; ?>

            <form class="sec-form" method="post" action="<?= url('contacto') ?>#formulario" novalidate>
                <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
                <div class="sec-hp" aria-hidden="true">
                    <label>No llenar <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                </div>

                <div class="sec-form-row">
                    <label class="<?= isset($errores['nombre']) ? 'has-error' : '' ?>">
                        <span>Nombre *</span>
                        <input type="text" name="nombre" value="<?= e($campos['nombre']) ?>" required maxlength="100" autocomplete="name">
                        <?php if (isset($errores['nombre'])): ?><em><?= e($errores['nombre']) ?></em><?php endif; ?>
                    </label>
                    <label>
                        <span>Empresa</span>
                        <input type="text" name="empresa" value="<?= e($campos['empresa']) ?>" autocomplete="organization">
                    </label>
                </div>

                <div class="sec-form-row">
                    <label class="<?= isset($errores['email']) ? 'has-error' : '' ?>">
                        <span>Correo electrónico *</span>
                        <input type="email" name="email" value="<?= e($campos['email']) ?>" required autocomplete="email">
                        <?php if (isset($errores['email'])): ?><em><?= e($errores['email']) ?></em><?php endif; ?>
                    </label>
                    <label>
                        <span>Teléfono</span>
                        <input type="tel" name="telefono" value="<?= e($campos['telefono']) ?>" autocomplete="tel">
                    </label>
                </div>

                <label>
                    <span>Servicio de interés</span>
                    <select name="servicio">
                        <option value="">Selecciona un servicio</option>
                        <?php foreach ($servicios as $s): ?>
                            <option value="<?= e($s['titulo']) ?>" <?= $campos['servicio'] === $s['titulo'] ? 'selected' : '' ?>><?= e($s['titulo']) ?></option>
                        <?php endforeach; ?>
                        <option value="Otro" <?= $campos['servicio'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </label>

                <label class="<?= isset($errores['mensaje']) ? 'has-error' : '' ?>">
                    <span>Mensaje *</span>
                    <textarea name="mensaje" rows="6" required maxlength="5000"><?= e($campos['mensaje']) ?></textarea>
                    <?php if (isset($errores['mensaje'])): ?><em><?= e($errores['mensaje']) ?></em><?php endif; ?>
                </label>

                <button type="submit" class="sec-btn">Enviar mensaje <i class="icon-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
