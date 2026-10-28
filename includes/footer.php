                    </div>
                </div>
            </div>
        </div>

        <footer id="Footer" class="clearfix sec-footer">
            <div class="widgets_wrapper">
                <div class="container">
                    <div class="column one-third">
                        <a href="<?= url() ?>" class="sec-footer-logo">
                            <img src="<?= asset('assets/images/sec/logo-sec-circulo.png') ?>" alt="Logo SEC">
                            <span><strong>Servicios de Especialidad</strong> y Consultorías</span>
                        </a>
                        <p><?= e($site['descripcion']) ?></p>
                    </div>
                    <div class="column one-third">
                        <h4>Secciones</h4>
                        <ul class="sec-footer-links">
                            <?php foreach ($menu as $item): ?>
                                <li><a href="<?= e($item['url']) ?>"><?= e($item['titulo']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="column one-third">
                        <h4>Contacto</h4>
                        <ul class="sec-footer-contact">
                            <?php foreach ($site['telefonos'] as $tel): ?>
                                <li><i class="icon-phone"></i><a href="<?= e(tel_link($tel)) ?>"><?= e($tel) ?></a></li>
                            <?php endforeach; ?>
                            <li><i class="icon-mail"></i><a href="mailto:<?= e($site['email']) ?>"><?= e($site['email']) ?></a></li>
                            <li><i class="icon-clock"></i>Atención al cliente 24/7</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer_copy">
                <div class="container">
                    <div class="column one">
                        <div class="copyright">
                            &copy; <?= date('Y') ?> <?= e($site['nombre_largo']) ?>. Todos los derechos reservados.
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div id="Side_slide" class="right dark">
        <div class="close-wrapper">
            <a href="#" class="close" aria-label="Cerrar menú"><i class="icon-cancel-fine"></i></a>
        </div>
        <div class="extras">
            <a href="<?= e(tel_link($site['telefonos'][0])) ?>" class="action_button"><i class="icon-phone"></i> <?= e($site['telefonos'][0]) ?></a>
            <div class="extras-wrapper"></div>
        </div>
        <div class="menu_wrapper"></div>
    </div>
    <div id="body_overlay"></div>

    <script src="<?= asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= asset('js/jquery-migrate-3.4.0.min.js') ?>"></script>
    <script src="<?= asset('js/mfn.menu.js') ?>"></script>
    <script src="<?= asset('js/jquery.plugins.js') ?>"></script>
    <script src="<?= asset('js/animations/animations.js') ?>"></script>
    <script src="<?= asset('js/translate3d.js') ?>"></script>
    <script src="<?= asset('js/scripts.js') ?>"></script>
    <script src="<?= asset('assets/js/sec.js') ?>"></script>
</body>

</html>
