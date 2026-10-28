<?php
header('Content-Type: text/plain; charset=UTF-8');
?>
User-agent: *
Disallow: /includes/
Disallow: /pages/
Disallow: /seo3/
Disallow: /*.html$

Sitemap: <?= abs_url(url('sitemap.xml')) ?>
