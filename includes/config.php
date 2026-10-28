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
    'descripcion'  => 'Empresa especializada en geotecnia, geología, hidrología y geomecánica minera. Soluciones técnicas con los más altos estándares de calidad y seguridad.',
    'telefonos'    => ['(331) 468-5868', '(444) 739-9291'],
    'email'        => 'enriqueholm@hotmail.com',
    // Correo que recibe los mensajes del formulario de contacto
    'email_contacto' => 'enriqueholm@hotmail.com',
];

$menu = [
    'inicio'     => ['titulo' => 'Inicio',     'url' => url()],
    'soluciones' => ['titulo' => 'Soluciones', 'url' => url('soluciones')],
    'casos'      => ['titulo' => 'Casos',      'url' => url('casos')],
    'nosotros'   => ['titulo' => 'Nosotros',   'url' => url('nosotros')],
    'contacto'   => ['titulo' => 'Contacto',   'url' => url('contacto')],
];

$nosotros = 'Somos una empresa especializada en geotecnia, con experiencia en el desarrollo, diseño y ejecución de proyectos integrales en las áreas de geología e hidrología. Nuestra misión es ofrecer soluciones técnicas con los más altos estándares de calidad y seguridad.';

$mision = 'Proporcionar soluciones técnicas innovadoras y sostenibles en ingeniería geotécnica, aportando valor a nuestros clientes mediante el uso de tecnología de punta y talento humano calificado.';

$vision = 'Consolidarnos como una empresa líder a nivel nacional en servicios de ingeniería geotécnica, siendo reconocidos por nuestra excelencia técnica, responsabilidad social y compromiso con el medio ambiente.';

$certificaciones = 'Contamos con un equipo multidisciplinario certificado en normas nacionales e internacionales, incluyendo STPS, NOM, ACI, ASTM e instituciones de ingeniería geotécnica y geológica.';

$normas = ['STPS', 'NOM', 'ACI', 'ASTM'];

$equipo = [
    ['nombre' => 'Ing. Enrique Ledesma Holm',   'cargo' => 'Operaciones Generales'],
    ['nombre' => 'Ing. Diana E. Castañeda',     'cargo' => 'Coordinación y Logística'],
    ['nombre' => 'Lic. Carlos Castillo Glz.',   'cargo' => 'Finanzas'],
];

// Servicios principales (icono = clase de mfn-icons de la plantilla)
$servicios = [
    ['titulo' => 'Estudios geotécnicos',            'texto' => 'Estudios geotécnicos y de mecánica de suelos.',                                                                       'icono' => 'icon-database'],
    ['titulo' => 'Hidrogeología e hidrología',      'texto' => 'Elaboración de estudios hidrogeológicos e hidrológicos.',                                                             'icono' => 'icon-water'],
    ['titulo' => 'Estudios geológicos',             'texto' => 'Elaboración de estudios geológicos.',                                                                                 'icono' => 'icon-globe'],
    ['titulo' => 'Estabilidad de taludes',          'texto' => 'Diseño y análisis de estabilidad de taludes.',                                                                        'icono' => 'icon-chart-line'],
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

// Proyectos destacados (CV págs. 2 y 3). Nombres tal como aparecen en el CV.
$proyectos = [
    [
        'titulo' => 'Modelos geotécnicos',
        'texto'  => 'Amplia experiencia en la elaboración de modelos geotécnicos completos para empresas líderes en el sector minero.',
        'clientes' => ['Grupo Calidra', 'Peñoles', 'FMSC', 'Cemex', 'Sierra Madre Gold and Silver', 'Silver Storm Mining'],
    ],
    [
        'titulo' => 'Modelos geológico-estructurales',
        'texto'  => 'Elaboración de modelos geológico-estructurales completos para empresas líderes en el sector minero.',
        'clientes' => ['Silver Storm Mining', 'First Majestic Silver Corp', 'Grupo Calidra', 'GoldGroup Mining Inc.', 'Oroco Resources SA de CV'],
    ],
    [
        'titulo' => 'Modelos hidrológicos',
        'texto'  => 'Elaboración de modelos hidrológicos para empresas líderes en el sector minero.',
        'clientes' => ['Silver Storm Mining', 'First Majestic Silver Corp', 'Grupo Calidra', 'Cemex'],
    ],
];

// Lista única de clientes para la franja de logos/nombres
$clientes = array_values(array_unique(array_merge(...array_column($proyectos, 'clientes'))));

$galeria_dir = asset('assets/images/sec/galeria/');
$galeria = [
    ['img' => 'proyecto-15.jpg', 'titulo' => 'Mina a cielo abierto',              'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-07.jpg', 'titulo' => 'Barrenación en desarrollo subterráneo', 'cat' => 'subterranea'],
    ['img' => 'proyecto-04.jpg', 'titulo' => 'Pruebas de laboratorio',            'cat' => 'laboratorio'],
    ['img' => 'proyecto-16.jpg', 'titulo' => 'Diseño de bancos y taludes',        'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-02.jpg', 'titulo' => 'Fortificación con marcos',          'cat' => 'subterranea'],
    ['img' => 'proyecto-10.jpg', 'titulo' => 'Inspección en sitio',               'cat' => 'cielo-abierto'],
    ['img' => 'proyecto-08.jpg', 'titulo' => 'Supervisión geomecánica',           'cat' => 'subterranea'],
    ['img' => 'proyecto-05.jpg', 'titulo' => 'Control y monitoreo',               'cat' => 'laboratorio'],
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
