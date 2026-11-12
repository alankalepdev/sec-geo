<?php
header('Content-Type: text/plain; charset=UTF-8');
?>
User-agent: *
Disallow: /includes/
Disallow: /pages/
Disallow: /vendor/

Sitemap: <?= abs_url(url('sitemap.xml')) ?>
