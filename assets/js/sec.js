/* SEC · slider de inicio, filtros y lightbox de galería */
(function () {
	'use strict';

	/* ---------- Slider ---------- */
	var slider = document.getElementById('sec-slider');

	if (slider) {
		var slides = slider.querySelectorAll('.sec-slide');
		var dots = slider.querySelectorAll('.sec-slider-dots button');
		var actual = 0;
		var intervalo = 7000;
		var timer;

		var ir = function (n) {
			slides[actual].classList.remove('is-active');
			dots[actual].classList.remove('is-active');
			actual = (n + slides.length) % slides.length;
			slides[actual].classList.add('is-active');
			dots[actual].classList.add('is-active');
		};

		var reiniciar = function () {
			clearInterval(timer);
			timer = setInterval(function () { ir(actual + 1); }, intervalo);
		};

		slider.querySelector('.prev').addEventListener('click', function () { ir(actual - 1); reiniciar(); });
		slider.querySelector('.next').addEventListener('click', function () { ir(actual + 1); reiniciar(); });

		dots.forEach(function (dot, i) {
			dot.addEventListener('click', function () { ir(i); reiniciar(); });
		});

		// Deslizar en pantallas táctiles
		var inicioX = null;
		slider.addEventListener('touchstart', function (e) { inicioX = e.touches[0].clientX; }, { passive: true });
		slider.addEventListener('touchend', function (e) {
			if (inicioX === null) return;
			var dx = e.changedTouches[0].clientX - inicioX;
			if (Math.abs(dx) > 50) { ir(actual + (dx < 0 ? 1 : -1)); reiniciar(); }
			inicioX = null;
		});

		if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			reiniciar();
		}
	}

	/* ---------- Filtros de galería ---------- */
	document.querySelectorAll('.sec-filters button').forEach(function (boton, _, botones) {
		boton.addEventListener('click', function () {
			var filtro = boton.getAttribute('data-filter');
			botones.forEach(function (b) { b.classList.toggle('is-active', b === boton); });
			document.querySelectorAll('.sec-gallery-item[data-cat]').forEach(function (item) {
				item.classList.toggle('is-hidden', filtro !== '*' && item.getAttribute('data-cat') !== filtro);
			});
		});
	});

	/* ---------- Lightbox ---------- */
	var enlaces = document.querySelectorAll('[data-lightbox]');
	if (!enlaces.length) return;

	var lb = document.createElement('div');
	lb.className = 'sec-lightbox';
	lb.setAttribute('role', 'dialog');
	lb.setAttribute('aria-modal', 'true');
	lb.innerHTML =
		'<button class="lb-close" type="button" aria-label="Cerrar"><i class="icon-cancel-fine"></i></button>' +
		'<button class="lb-prev" type="button" aria-label="Anterior"><i class="icon-left-open-big"></i></button>' +
		'<figure><img alt=""><figcaption></figcaption></figure>' +
		'<button class="lb-next" type="button" aria-label="Siguiente"><i class="icon-right-open-big"></i></button>';
	document.body.appendChild(lb);

	var img = lb.querySelector('img');
	var caption = lb.querySelector('figcaption');
	var grupo = [];
	var indice = 0;

	var mostrar = function (i) {
		indice = (i + grupo.length) % grupo.length;
		img.src = grupo[indice].href;
		img.alt = grupo[indice].title;
		caption.textContent = grupo[indice].title;
	};

	var cerrar = function () {
		lb.classList.remove('is-open');
		document.body.style.overflow = '';
	};

	enlaces.forEach(function (enlace) {
		enlace.addEventListener('click', function (e) {
			e.preventDefault();
			var nombre = enlace.getAttribute('data-lightbox');
			// Solo las imágenes visibles del mismo grupo (respeta los filtros)
			grupo = Array.prototype.filter.call(
				document.querySelectorAll('[data-lightbox="' + nombre + '"]'),
				function (el) { return !el.classList.contains('is-hidden'); }
			);
			mostrar(grupo.indexOf(enlace));
			lb.classList.add('is-open');
			document.body.style.overflow = 'hidden';
		});
	});

	lb.querySelector('.lb-close').addEventListener('click', cerrar);
	lb.querySelector('.lb-prev').addEventListener('click', function () { mostrar(indice - 1); });
	lb.querySelector('.lb-next').addEventListener('click', function () { mostrar(indice + 1); });
	lb.addEventListener('click', function (e) { if (e.target === lb) cerrar(); });

	document.addEventListener('keydown', function (e) {
		if (!lb.classList.contains('is-open')) return;
		if (e.key === 'Escape') cerrar();
		if (e.key === 'ArrowLeft') mostrar(indice - 1);
		if (e.key === 'ArrowRight') mostrar(indice + 1);
	});
})();
