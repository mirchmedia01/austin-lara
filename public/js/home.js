(function () {
    'use strict';

    function init() {
        var carousel = document.querySelector('.elementor-element-06f9edf .e-n-carousel');
        if (!carousel || carousel.dataset.logoMarquee === '1') {
            return;
        }

        var wrap = carousel.querySelector('.swiper-wrapper');
        if (!wrap) {
            return;
        }

        var slides = Array.prototype.slice.call(wrap.querySelectorAll('.swiper-slide'));
        if (slides.length === 0) {
            return;
        }

        slides.forEach(function (slide) {
            var clone = slide.cloneNode(true);
            clone.setAttribute('aria-hidden', 'true');
            clone.removeAttribute('aria-label');
            wrap.appendChild(clone);
        });

        wrap.classList.add('logo-marquee');
        carousel.dataset.logoMarquee = '1';
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
