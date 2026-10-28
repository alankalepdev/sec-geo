<?php
session_start();
require_once __DIR__ . '/../includes/config.php';

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
    if ($campos['nombre'] === '') {
        $errores['nombre'] = 'Escribe tu nombre.';
    }
    if (!filter_var($campos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Escribe un correo electrónico válido.';
    }
    if ($campos['mensaje'] === '') {
        $errores['mensaje'] = 'Cuéntanos sobre tu proyecto.';
    }

    if (!$errores) {
        $enviado = true;
        if (!$es_bot) {
            // Evitar inyección de cabeceras
            $limpio = fn($v) => str_replace(["\r", "\n"], ' ', $v);

            $asunto = 'Nuevo contacto desde el sitio web: ' . $limpio($campos['nombre']);
            $cuerpo = "Nombre: {$campos['nombre']}\n"
                    . "Empresa: {$campos['empresa']}\n"
                    . "Correo: {$campos['email']}\n"
                    . "Teléfono: {$campos['telefono']}\n"
                    . "Servicio de interés: {$campos['servicio']}\n\n"
                    . "Mensaje:\n{$campos['mensaje']}\n";
            $cabeceras = "From: Sitio web SEC <no-reply@{$_SERVER['SERVER_NAME']}>\r\n"
                       . 'Reply-To: ' . $limpio($campos['email']) . "\r\n"
                       . "Content-Type: text/plain; charset=UTF-8\r\n";

            $enviado = @mail($site['email_contacto'], '=?UTF-8?B?' . base64_encode($asunto) . '?=', $cuerpo, $cabeceras);
        }

        // Post/Redirect/Get para evitar reenvíos al recargar
        header('Location: ' . url('contacto') . '?enviado=' . ($enviado ? 'ok' : 'error') . '#formulario');
        exit;
    }
}

$pagina        = 'contacto';
$titulo_pagina = 'Contacto';
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
                <?php foreach ($site['telefonos'] as $tel): ?>
                    <li>
                        <i class="icon-phone"></i>
                        <div><small>Teléfono</small><a href="<?= e(tel_link($tel)) ?>"><?= e($tel) ?></a></div>
                    </li>
                <?php endforeach; ?>
                <li>
                    <i class="icon-mail"></i>
                    <div><small>Correo electrónico</small><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></div>
                </li>
                <li>
                    <i class="icon-clock"></i>
                    <div><small>Horario</small>Atención al cliente 24/7</div>
                </li>
            </ul>

            <h3 class="sec-contact-subtitle">Atención</h3>
            <ul class="sec-contact-team">
                <?php foreach ($equipo as $persona): ?>
                    <li><strong><?= e($persona['nombre']) ?></strong><span><?= e($persona['cargo']) ?></span></li>
                <?php endforeach; ?>
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
                        <input type="text" name="nombre" value="<?= e($campos['nombre']) ?>" required autocomplete="name">
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
                    <textarea name="mensaje" rows="6" required><?= e($campos['mensaje']) ?></textarea>
                    <?php if (isset($errores['mensaje'])): ?><em><?= e($errores['mensaje']) ?></em><?php endif; ?>
                </label>

                <button type="submit" class="sec-btn">Enviar mensaje <i class="icon-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../includes/footer.php'; ?>
