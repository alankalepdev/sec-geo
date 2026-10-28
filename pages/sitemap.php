<?php
// Sitemap XML generado a partir del menú
header('Content-Type: application/xml; charset=UTF-8');
$modificado = date('Y-m-d', filemtime(__DIR__ . '/../includes/config.php'));

echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($menu as $clave => $item): ?>
    <url>
        <loc><?= e(abs_url($item['url'])) ?></loc>
        <lastmod><?= $modificado ?></lastmod>
        <priority><?= $clave === 'inicio' ? '1.0' : '0.8' ?></priority>
    </url>
<?php endforeach; ?>
</urlset>
