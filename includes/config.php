<?php
/**
 * Configuración y contenido central del sitio SEC
 * Servicios de Especialidad y Consultorías
 */

// Ruta base del sitio ("/" en la raíz del dominio o "/carpeta/" si vive en un subdirectorio)
if (!defined('BASE_URL')) {
    $raiz_doc = realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '';
    $raiz_sitio = realpath(__DIR__ . '/..');
    $base = ($raiz_doc && strpos($raiz_sitio, $raiz_doc) === 0)
        ? str_replace('\\', '/', substr($raiz_sitio, strlen($raiz_doc)))
        : '';
    define('BASE_URL', rtrim($base, '/') . '/');
}

/** URL limpia de una ruta: url('soluciones') → /soluciones */
function url($ruta = '')
{
    return BASE_URL . ltrim($ruta, '/');
}

/** URL de un archivo estático: asset('assets/css/sec.css') */
function asset($archivo)
{
    return BASE_URL . ltrim($archivo, '/');
}

$site = [
    'nombre'       => 'SEC',
    'nombre_largo' => 'Servicios de Especialidad y Consultorías',
    'lema'         => 'Ingeniería especializada. Soluciones estratégicas. Confianza técnica.',
    'descripcion'  => 'Consultoría integral en geomecánica, geotecnia, geología y geohidrología para minería subterránea y a cielo abierto.',
    // WhatsApp de atención. TODO: número por confirmar (el cliente contratará una línea de trabajo)
    'whatsapp'     => '(331) 468-5868',
    'email'        => 'serviciocliente@secgeo.com',
    // Correo que recibe los mensajes del formulario de contacto
    'email_contacto' => 'serviciocliente@secgeo.com',
];

$menu = [
    'inicio'     => ['titulo' => 'Inicio',     'url' => url()],
    'soluciones' => ['titulo' => 'Soluciones', 'url' => url('soluciones')],
    'casos'      => ['titulo' => 'Casos',      'url' => url('casos')],
    'nosotros'   => ['titulo' => 'Nosotros',   'url' => url('nosotros')],
    'contacto'   => ['titulo' => 'Contacto',   'url' => url('contacto')],
];

$nosotros_titulo = 'Ingeniería especializada para los desafíos de la industria minera';

// Primer párrafo = resumen que también se muestra en inicio
$nosotros = [
    'Somos una empresa de consultoría especializada en geociencias e ingeniería minera, enfocada en el desarrollo de soluciones técnicas integrales en geomecánica, geotecnia, geología y geohidrología.',
    'Integramos experiencia profesional, análisis técnico y herramientas avanzadas de ingeniería para abordar los desafíos asociados con el diseño, la evaluación y la optimización de proyectos mineros subterráneos y a cielo abierto.',
    'Nuestra metodología se orienta a la identificación y gestión de riesgos, la evaluación del comportamiento del macizo rocoso y de los materiales geológicos, la estabilidad de las estructuras mineras y la optimización técnico-económica de las soluciones propuestas.',
    'En SEC entendemos que cada proyecto requiere un enfoque específico. Por ello, desarrollamos soluciones fundamentadas en las condiciones particulares de cada sitio, los objetivos operativos, los criterios de diseño y los requisitos normativos aplicables.',
    'Nuestro compromiso es aportar conocimiento especializado, rigor técnico y soluciones confiables que contribuyan a la seguridad, la eficiencia operativa y la generación de valor para nuestros clientes.',
];

$mision = 'Proporcionar soluciones técnicas innovadoras y sostenibles en ingeniería geotécnica, aportando valor a nuestros clientes mediante el uso de tecnología de punta y talento humano calificado.';

$vision = 'Consolidarnos como una empresa líder a nivel nacional en servicios de ingeniería geotécnica, siendo reconocidos por nuestra excelencia técnica, responsabilidad social y compromiso con el medio ambiente.';

$certificaciones = 'Contamos con un equipo multidisciplinario certificado en normas nacionales e internacionales, incluyendo STPS, NOM, ACI, ASTM e instituciones de ingeniería geotécnica y geológica.';

$normas = ['STPS', 'NOM', 'ACI', 'ASTM'];

$equipo = [
    ['nombre' => 'Ing. Enrique L. Holm',        'cargo' => 'Operaciones Generales'],
    ['nombre' => 'Ing. Diana E. Castañeda',     'cargo' => 'Coordinación y Logística'],
    ['nombre' => 'Lic. Carlos Castillo',        'cargo' => 'Finanzas'],
];

// Servicios principales (icono = clase de mfn-icons de la plantilla)
$servicios = [
    ['titulo' => 'Estudios geomecánicos',           'texto' => 'Estudios de mecánica de rocas conforme a las NOM oficiales vigentes; pueden incluir capacitación con entrega de DC3 oficiales.', 'icono' => 'icon-database'],
    ['titulo' => 'Hidrogeología e hidrología',      'texto' => 'Elaboración de estudios hidrogeológicos e hidrológicos.',                                                             'icono' => 'icon-water'],
    ['titulo' => 'Estudios geológicos',             'texto' => 'Elaboración de estudios geológicos conforme a las NOM oficiales vigentes.',                                           'icono' => 'icon-globe'],
    ['titulo' => 'Estudios geotécnicos',            'texto' => 'Estudios geotécnicos y de mecánica de suelos.',                                                                       'icono' => 'icon-chart-line'],
    ['titulo' => 'Controles de estabilidad',        'texto' => 'Diseño y secuenciamiento (o evaluación) de los controles de estabilidad en minería subterránea y a cielo abierto.',  'icono' => 'icon-flow-tree'],
    ['titulo' => 'Fortificación y soporte',         'texto' => 'Diseño y análisis de estándares de fortificación o soporte en minería subterránea y a cielo abierto.',               'icono' => 'icon-traffic-cone'],
    ['titulo' => 'Pruebas de campo y laboratorio',  'texto' => 'Colecta y elaboración de pruebas de campo y laboratorio.',                                                           'icono' => 'icon-beaker-line'],
    ['titulo' => 'Mapeo geológico',                 'texto' => 'Mapeo geológico y caracterización del terreno.',                                                                      'icono' => 'icon-map'],
    ['titulo' => 'Vuelos fotogramétricos',          'texto' => 'Realización de vuelos fotogramétricos para validación de volumetrías ante minados de especialidad.',                 'icono' => 'icon-camera'],
];

// Experiencia geólogo-geomecánica (CV págs. 4 y 5)
$experiencia = [
    'Proyectos de hundimiento de subniveles, bloques y paneles (desde el concepto de prefactibilidad hasta el nivel de factibilidad óptima).',
    'Formulación de metodologías de minado y sus funcionalidades, generando indicaciones sobre los criterios de diseño de la mina y sus conceptos de escala bajo criterios de NOM actuales aplicables.',
    'Elaboración de secuencias y retroceso de infraestructura y accesos, considerando siempre los factores de seguridad, costos y viabilidades operativas.',
    'Generación de bases de datos para el óptimo secuenciamiento de obras mineras, estabilidad, soporte de terreno y sismicidad inducida bajo las condiciones geológico-estructurales locales y puntuales.',
    'Aplicación de metodologías numéricas continuas y discontinuas tridimensionales para la correcta evaluación de la estabilidad de excavaciones.',
    'Evaluación de capacidades de hundimiento, rendimientos de niveles de extracción, velocidad de hundimiento superficial, fragmentación primaria y comportamiento del macizo rocoso ante las afectaciones producidas por el block caving (sub level caving), así como su seguimiento y control.',
    'Elaboración de secuencias y selección de relleno (análisis y diseños de CRF).',
    'Aplicación e implementación del QA/QC en los diferentes procesos operativos para eficientizar los pasos.',
    'Implementación de mejoras en los controles de dilución, factores de carga y en plantillas de voladura.',
    'Evaluación y análisis de afectaciones post operativas y monitoreo de los escenarios posibles por cambios en los secuenciamientos.',
    'Desarrollo de planes de fortificación de obras, implantación de sistemas de desarrollo con controles de calidad en operación y elaboración de plantillas de barrenación para LH, SBL, C&F, etc.',
    'Elaboración y actualización de modelos geomecánicos, así como sus estándares geotécnicos.',
    'Selección de métodos de minado y sus controles de dilución.',
    'Prospección de costos, tiempo y sus sistemas de fortificación a corto, mediano y largo plazo, así como los análisis de LOM.',
    'Evaluación y cálculo de pilares para desarrollo y recuperación de niveles (incluyendo análisis costo-beneficio), soportados con factores de seguridad permisibles en las NOM actuales.',
    'Elaboración y actualización de modelos de bloques según las caracterizaciones geotécnicas RMR, Q, GSI, etc.',
    'Elaboración de planes de desarrollo matricial según PAP\'s, KPI\'s, POM, entre otros.',
];

// Líneas de modelado (CV págs. 2 y 3)
$proyectos = [
    ['titulo' => 'Modelos geomecánicos',            'texto' => 'Elaboración de modelos geomecánicos completos para empresas líderes en el sector minero.'],
    ['titulo' => 'Modelos geotécnicos',             'texto' => 'Amplia experiencia en la elaboración de modelos geotécnicos completos para empresas líderes en el sector minero.'],
    ['titulo' => 'Modelos geológico-estructurales', 'texto' => 'Elaboración de modelos geológico-estructurales completos para empresas líderes en el sector minero.'],
    ['titulo' => 'Modelos hidrológicos',            'texto' => 'Elaboración de modelos hidrológicos para empresas líderes en el sector minero.'],
];

// Empresas que han confiado en nosotros (logo en assets/images/sec/clientes/; sin logo se muestra el nombre)
$clientes_dir = asset('assets/images/sec/clientes/');
$clientes = [
    ['nombre' => 'Grupo Calidra',                'logo' => 'calidra.png'],
    ['nombre' => 'Peñoles',                      'logo' => 'penoles.png'],
    ['nombre' => 'FMSC',                         'logo' => ''],
    ['nombre' => 'Cemex',                        'logo' => 'cemex.png'],
    ['nombre' => 'Sierra Madre Gold and Silver', 'logo' => 'sierramadre.png'],
    ['nombre' => 'Silver Storm Mining',          'logo' => 'silverstorm.png'],
    ['nombre' => 'First Majestic Silver Corp',   'logo' => 'firstmajestic.png'],
    ['nombre' => 'GoldGroup Mining Inc.',        'logo' => 'goldgroup.png'],
    ['nombre' => 'Oroco Resources SA de CV',     'logo' => 'oroco.png'],
    ['nombre' => 'Luca Mining',                  'logo' => 'luca.png'],
    ['nombre' => 'DMV Mining Intelligence',      'logo' => 'mining.png'],
];

$galeria_dir = asset('assets/images/sec/galeria/');
$galeria = [
    ['img' => 'proyecto-15.jpg', 'titulo' => 'Mina a cielo abierto',              'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-07.jpg', 'titulo' => 'Barrenación en desarrollo subterráneo', 'cat' => 'subterranea'],
    ['img' => 'proyecto-16.jpg', 'titulo' => 'Diseño de bancos y taludes',        'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-02.jpg', 'titulo' => 'Fortificación con marcos',          'cat' => 'subterranea'],
    ['img' => 'proyecto-10.jpg', 'titulo' => 'Inspección en sitio',               'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-08.jpg', 'titulo' => 'Supervisión geomecánica',           'cat' => 'subterranea'],
    ['img' => 'proyecto-01.jpg', 'titulo' => 'Equipo de anclaje',                 'cat' => 'subterranea'],
    ['img' => 'proyecto-17.jpg', 'titulo' => 'Caracterización del macizo rocoso', 'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-06.jpg', 'titulo' => 'Ensayos de campo',                  'cat' => 'laboratorio'],
    ['img' => 'proyecto-09.jpg', 'titulo' => 'Soporte con malla y anclas',        'cat' => 'subterranea'],
    ['img' => 'proyecto-03.jpg', 'titulo' => 'Obra subterránea',                  'cat' => 'subterranea'],
    ['img' => 'proyecto-11.jpg', 'titulo' => 'Muestreo en campo',                 'cat' => 'laboratorio'],
    ['img' => 'proyecto-14.jpg', 'titulo' => 'Contrapozo fortificado',            'cat' => 'subterranea'],
    ['img' => 'proyecto-13.jpg', 'titulo' => 'Análisis de estabilidad de talud',  'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-12.jpg', 'titulo' => 'Probetas para ensayo',              'cat' => 'laboratorio'],
];

$galeria_categorias = [
    'cielo-abierto' => 'Cielo abierto',
    'subterranea'   => 'Minería subterránea',
    'laboratorio'   => 'Campo y laboratorio',
];

function e($texto)
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function tel_link($telefono)
{
    return 'tel:+52' . preg_replace('/\D/', '', $telefono);
}

function whatsapp_link($telefono)
{
    return 'https://wa.me/52' . preg_replace('/\D/', '', $telefono);
}
