<ul class="sec-logos">
    <?php foreach ($clientes as $c): ?>
        <li title="<?= e($c['nombre']) ?>">
            <?php if ($c['logo']): ?>
                <img src="<?= e($clientes_dir . $c['logo']) ?>" alt="<?= e($c['nombre']) ?>" loading="lazy">
            <?php else: ?>
                <span><?= e($c['nombre']) ?></span>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
