<?php
/**
 * Envío de correos del formulario de contacto con PHPMailer.
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

// Hora de México en la fecha de recepción del correo
date_default_timezone_set('America/Mexico_City');

/** Configuración SMTP (includes/mail.config.php) o null si no existe */
function mail_config()
{
    static $config = false;
    if ($config === false) {
        $archivo = __DIR__ . '/mail.config.php';
        $config = is_file($archivo) ? require $archivo : null;
    }
    return $config;
}

/** PHPMailer listo para enviar: SMTP si hay configuración, mail() del servidor si no */
function crear_mailer()
{
    global $site;
    $config = mail_config();

    $mail = new PHPMailer(true);
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->setLanguage('es');

    if ($config) {
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->Port       = (int) $config['puerto'];
        $mail->SMTPAuth   = $config['usuario'] !== '';
        $mail->Username   = $config['usuario'];
        $mail->Password   = $config['contrasena'];
        $mail->SMTPSecure = $config['seguridad'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS
                          : ($config['seguridad'] === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : '');
        $mail->SMTPAutoTLS = $config['seguridad'] !== '';
        $mail->Timeout    = 15;
        $mail->setFrom($config['de_correo'], $config['de_nombre']);
    } else {
        $mail->isMail();
        // Remitente del dominio oficial (no del host con que se visita, que puede ser una IP o "www.")
        $dominio = preg_replace('/^www\./', '', parse_url(SITE_URL_PRODUCCION, PHP_URL_HOST));
        $mail->setFrom('no-reply@' . $dominio, 'Sitio web SEC');
    }

    return $mail;
}

/** Colores de la marca para los correos */
const MAIL_AZUL    = '#1c3b4f';
const MAIL_NARANJA = '#e7762b';
const MAIL_GRIS    = '#6b7c88';
const MAIL_FONDO   = '#f2f4f6';

/**
 * Envuelve el contenido en la plantilla de correo de SEC (tablas y estilos en línea,
 * que es lo que respetan Gmail, Outlook y los clientes móviles).
 */
function plantilla_correo($preencabezado, $contenido)
{
    global $site;
    $logo = SITE_URL_PRODUCCION . '/assets/images/sec/logo-sec-600.jpg';
    $web  = SITE_URL_PRODUCCION;

    return '<!doctype html><html lang="es"><head><meta charset="utf-8">'
        . '<meta name="viewport" content="width=device-width,initial-scale=1"><title>' . e($site['nombre_largo']) . '</title></head>'
        . '<body style="margin:0;padding:0;background:' . MAIL_FONDO . '">'
        // Texto de vista previa en la bandeja (oculto en el cuerpo)
        . '<div style="display:none;max-height:0;overflow:hidden;opacity:0">' . e($preencabezado) . '</div>'
        . '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:' . MAIL_FONDO . '"><tr><td align="center" style="padding:24px 12px">'
        . '<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:8px;overflow:hidden;font-family:Arial,Helvetica,sans-serif">'
        // Encabezado
        . '<tr><td style="padding:24px 32px;border-bottom:4px solid ' . MAIL_NARANJA . '">'
        . '<table role="presentation" cellpadding="0" cellspacing="0"><tr>'
        . '<td style="padding-right:14px"><img src="' . e($logo) . '" width="56" height="56" alt="SEC" style="display:block;border:0;border-radius:4px"></td>'
        . '<td style="font-size:18px;font-weight:bold;color:' . MAIL_AZUL . ';line-height:1.3">' . e($site['nombre_largo'])
        . '<br><span style="font-size:12px;font-weight:normal;color:' . MAIL_GRIS . '">' . e($site['lema']) . '</span></td>'
        . '</tr></table></td></tr>'
        // Contenido
        . '<tr><td style="padding:32px;font-size:15px;line-height:1.6;color:#333333">' . $contenido . '</td></tr>'
        // Pie
        . '<tr><td style="padding:20px 32px;background:' . MAIL_AZUL . ';font-size:12px;line-height:1.6;color:#c9d4dc">'
        . '<a href="' . e($web) . '" style="color:#ffffff;text-decoration:none;font-weight:bold">' . e(parse_url($web, PHP_URL_HOST)) . '</a>'
        . ' &nbsp;·&nbsp; <a href="mailto:' . e($site['email']) . '" style="color:#c9d4dc;text-decoration:none">' . e($site['email']) . '</a>'
        . ' &nbsp;·&nbsp; WhatsApp <a href="' . e(whatsapp_link($site['whatsapp'])) . '" style="color:#c9d4dc;text-decoration:none">' . e($site['whatsapp']) . '</a>'
        . '</td></tr>'
        . '</table></td></tr></table></body></html>';
}

/** Botón compatible con clientes de correo */
function boton_correo($texto, $href)
{
    return '<table role="presentation" cellpadding="0" cellspacing="0" style="margin:8px 0"><tr>'
        . '<td style="background:' . MAIL_NARANJA . ';border-radius:4px">'
        . '<a href="' . e($href) . '" style="display:inline-block;padding:12px 24px;font-size:15px;font-weight:bold;color:#ffffff;text-decoration:none">' . e($texto) . '</a>'
        . '</td></tr></table>';
}

/** Correo para la empresa con los datos del formulario, en texto y en HTML */
function cuerpo_contacto(array $campos)
{
    $vacio = '<span style="color:#b0bac2">No indicado</span>';

    // Valor ya escapado (con enlace cuando aplica)
    $correo   = '<a href="mailto:' . e($campos['email']) . '" style="color:' . MAIL_AZUL . '">' . e($campos['email']) . '</a>';
    $telefono = $campos['telefono'] !== ''
        ? '<a href="tel:' . e(preg_replace('/[^\d+]/', '', $campos['telefono'])) . '" style="color:' . MAIL_AZUL . '">' . e($campos['telefono']) . '</a>'
        : $vacio;

    $filas = [
        'Nombre'              => e($campos['nombre']),
        'Empresa'             => $campos['empresa'] !== '' ? e($campos['empresa']) : $vacio,
        'Correo'              => $correo,
        'Teléfono'            => $telefono,
        'Servicio de interés' => $campos['servicio'] !== '' ? e($campos['servicio']) : $vacio,
    ];

    $tabla = '';
    foreach ($filas as $etiqueta => $valor) {
        $tabla .= '<tr>'
            . '<td style="padding:10px 16px 10px 0;border-bottom:1px solid #e6eaee;font-size:13px;color:' . MAIL_GRIS . ';white-space:nowrap;vertical-align:top">' . e($etiqueta) . '</td>'
            . '<td style="padding:10px 0;border-bottom:1px solid #e6eaee;font-size:15px;color:' . MAIL_AZUL . ';font-weight:bold">' . $valor . '</td>'
            . '</tr>';
    }

    $contenido = '<h1 style="margin:0 0 6px;font-size:22px;color:' . MAIL_AZUL . '">Nuevo contacto desde el sitio web</h1>'
        . '<p style="margin:0 0 24px;font-size:13px;color:' . MAIL_GRIS . '">Recibido el ' . date('d/m/Y') . ' a las ' . date('H:i') . ' h</p>'
        . '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">' . $tabla . '</table>'
        . '<h2 style="margin:28px 0 10px;font-size:16px;color:' . MAIL_AZUL . '">Mensaje</h2>'
        . '<div style="padding:16px 18px;background:' . MAIL_FONDO . ';border-left:4px solid ' . MAIL_NARANJA . ';border-radius:4px;white-space:pre-line;color:#333333">' . e($campos['mensaje']) . '</div>'
        . '<p style="margin:28px 0 0">' . boton_correo('Responder a ' . $campos['nombre'], 'mailto:' . $campos['email']) . '</p>'
        . '<p style="margin:8px 0 0;font-size:12px;color:' . MAIL_GRIS . '">También puedes usar "Responder" en tu correo: la respuesta le llega directamente a esta persona.</p>';

    $texto = "NUEVO CONTACTO DESDE EL SITIO WEB\n"
        . 'Recibido el ' . date('d/m/Y H:i') . " h\n\n";
    foreach (['Nombre' => 'nombre', 'Empresa' => 'empresa', 'Correo' => 'email', 'Teléfono' => 'telefono', 'Servicio de interés' => 'servicio'] as $etiqueta => $clave) {
        $texto .= "$etiqueta: " . ($campos[$clave] !== '' ? $campos[$clave] : 'No indicado') . "\n";
    }
    $texto .= "\nMensaje:\n{$campos['mensaje']}\n";

    return [$texto, plantilla_correo('Mensaje de ' . $campos['nombre'] . ': ' . mb_substr($campos['mensaje'], 0, 90), $contenido)];
}

/** Acuse de recibo para quien llenó el formulario, en texto y en HTML */
function cuerpo_acuse(array $campos)
{
    global $site;

    $contenido = '<h1 style="margin:0 0 16px;font-size:22px;color:' . MAIL_AZUL . '">¡Gracias por escribirnos, ' . e($campos['nombre']) . '!</h1>'
        . '<p style="margin:0 0 16px">Recibimos tu mensaje y nuestro equipo se pondrá en contacto contigo a la brevedad.</p>'
        . ($campos['servicio'] !== '' ? '<p style="margin:0 0 16px">Servicio de interés: <strong style="color:' . MAIL_AZUL . '">' . e($campos['servicio']) . '</strong></p>' : '')
        . '<p style="margin:0 0 8px">Si necesitas atención inmediata, escríbenos por WhatsApp:</p>'
        . boton_correo('WhatsApp ' . $site['whatsapp'], whatsapp_link($site['whatsapp']))
        . '<p style="margin:24px 0 8px;font-size:13px;color:' . MAIL_GRIS . '">Esta es una copia de tu mensaje:</p>'
        . '<div style="padding:16px 18px;background:' . MAIL_FONDO . ';border-left:4px solid ' . MAIL_NARANJA . ';border-radius:4px;white-space:pre-line;font-size:14px;color:#555555">' . e($campos['mensaje']) . '</div>'
        . '<p style="margin:28px 0 0">Saludos,<br><strong style="color:' . MAIL_AZUL . '">' . e($site['nombre_largo']) . '</strong></p>';

    $texto = "Hola {$campos['nombre']},\n\n"
        . "Gracias por escribirnos. Recibimos tu mensaje y nuestro equipo se pondrá en contacto contigo a la brevedad.\n\n"
        . "Si necesitas atención inmediata, escríbenos por WhatsApp al {$site['whatsapp']}.\n\n"
        . "Copia de tu mensaje:\n{$campos['mensaje']}\n\n"
        . "{$site['nombre_largo']}\n{$site['lema']}\n" . SITE_URL_PRODUCCION . "\n";

    return [$texto, plantilla_correo('Recibimos tu mensaje. Te contactaremos a la brevedad.', $contenido)];
}

/**
 * Envía el mensaje a la empresa y, si está activado, el acuse al cliente.
 * Devuelve true si el correo a la empresa salió; el acuse es opcional y no afecta el resultado.
 */
function enviar_contacto(array $campos)
{
    global $site;
    [$texto, $html] = cuerpo_contacto($campos);

    try {
        $mail = crear_mailer();
        $mail->addAddress($site['email_contacto'], $site['nombre_largo']);
        $mail->addReplyTo($campos['email'], $campos['nombre']);
        $mail->Subject = 'Nuevo contacto desde el sitio web: ' . $campos['nombre'];
        $mail->isHTML(true);
        $mail->Body    = $html;
        $mail->AltBody = $texto;
        $mail->send();
    } catch (Exception $ex) {
        error_log('[SEC contacto] ' . $ex->getMessage());
        return false;
    }

    $config = mail_config();
    if ($config && !empty($config['acuse'])) {
        try {
            [$texto, $html] = cuerpo_acuse($campos);
            $acuse = crear_mailer();
            $acuse->addAddress($campos['email'], $campos['nombre']);
            $acuse->addReplyTo($site['email'], $site['nombre_largo']);
            $acuse->Subject = 'Recibimos tu mensaje | ' . $site['nombre_largo'];
            $acuse->isHTML(true);
            $acuse->Body    = $html;
            $acuse->AltBody = $texto;
            $acuse->send();
        } catch (Exception $ex) {
            error_log('[SEC contacto: acuse] ' . $ex->getMessage());
        }
    }

    return true;
}
