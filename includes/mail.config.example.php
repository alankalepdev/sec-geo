<?php
/**
 * Configuración SMTP para el formulario de contacto.
 * Copia este archivo como includes/mail.config.php y llena los datos.
 * mail.config.php no se sube a git (contiene la contraseña).
 *
 * Si mail.config.php no existe, se usa la función mail() del servidor.
 */
return [
    'host'       => 'mail.secgeoconsult.com',
    'puerto'     => 465,
    'seguridad'  => 'ssl',            // 'tls' (puerto 587), 'ssl' (puerto 465) o '' sin cifrado
    'usuario'    => 'no-reply@secgeoconsult.com',
    'contrasena' => 'TU_CONTRASEÑA',

    // Remitente de los correos (normalmente la misma cuenta del SMTP)
    'de_correo'  => 'no-reply@secgeoconsult.com',
    'de_nombre'  => 'Sitio web SEC',

    // Enviar acuse de recibo automático a quien llena el formulario
    'acuse'      => true,
];
