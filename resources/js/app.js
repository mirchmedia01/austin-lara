/**
 * Austin Optics — Frontend Interactions
 * Mobile navigation, sticky header, FAQ accordion, nav dropdowns.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        /* ─── Mobile Navigation ─────────────────────────────────────────── */
        var toggle = document.getElementById('mobile-menu-toggle');
        var nav = document.getElementById('mobile-nav');
        var closeBtn = document.getElementById('mobile-nav-close');

        // WordPress-parity pages render the original Elementor header, whose
        // burger has no working JS in the static export. Fall back to it for
        // opening the same sidebar drawer.
        var wpToggles = Array.prototype.slice.call(
            document.querySelectorAll('.elementor-menu-toggle')
        );

        function syncWpToggle(isOpen) {
            wpToggles.forEach(function (el) {
                el.classList.toggle('elementor-active', isOpen);
                el.setAttribute('aria-expanded', String(isOpen));
            });
        }

        function openNav() {
            if (!nav) return;
            nav.classList.add('is-open');
            nav.setAttribute('aria-hidden', 'false');
            if (toggle) {
                toggle.classList.add('is-open');
                toggle.setAttribute('aria-expanded', 'true');
            }
            syncWpToggle(true);
            document.body.style.overflow = 'hidden';
        }

        function closeNav() {
            if (!nav) return;
            nav.classList.remove('is-open');
            nav.setAttribute('aria-hidden', 'true');
            if (toggle) {
                toggle.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
            syncWpToggle(false);
            document.body.style.overflow = '';
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                if (nav && nav.classList.contains('is-open')) {
                    closeNav();
                } else {
                    openNav();
                }
            });
        } else if (wpToggles.length && nav) {
            // Elementor burger (WordPress-parity pages): open the sidebar,
            // and stop the dropdown <nav> from receiving the click.
            wpToggles.forEach(function (wpToggle) {
                wpToggle.addEventListener('click', function (event) {
                    event.preventDefault();
                    if (nav.classList.contains('is-open')) {
                        closeNav();
                    } else {
                        openNav();
                    }
                });
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeNav);
        }

        // Close the drawer when a nav link is followed.
        if (nav) {
            nav.addEventListener('click', function (event) {
                if (event.target.closest('a')) {
                    closeNav();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && nav.classList.contains('is-open')) {
                    closeNav();
                }
            });
        }

        // Expand/collapse grouped sublists inside the mobile drawer.
        var subParents = document.querySelectorAll('.mobile-nav__list > li');
        subParents.forEach(function (li) {
            var link = li.querySelector(':scope > .mobile-nav__link');
            var sublist = li.querySelector(':scope > .mobile-nav__sublist');
            if (!link || !sublist) return;
            sublist.classList.add('mobile-nav__sublist--collapsed');
            link.classList.add('mobile-nav__link--has-sub');
            link.addEventListener('click', function (event) {
                if (sublist.classList.contains('is-open')) {
                    event.preventDefault();
                    sublist.classList.remove('is-open');
                    link.setAttribute('aria-expanded', 'false');
                } else {
                    event.preventDefault();
                    sublist.classList.add('is-open');
                    link.setAttribute('aria-expanded', 'true');
                }
            });
        });

        /* ─── Sticky Header Shadow ──────────────────────────────────────── */
        var header = document.getElementById('site-header');

        function onScroll() {
            if (!header) return;
            if (window.scrollY > 8) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        /* ─── FAQ Accordion ────────────────────────────────────────────── */
        var faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function (item) {
            var question = item.querySelector('.faq-item__question');
            if (!question) return;

            question.addEventListener('click', function () {
                var isOpen = item.classList.contains('is-open');

                // Accordion behaviour: close any open sibling first.
                faqItems.forEach(function (other) {
                    if (other !== item) {
                        other.classList.remove('is-open');
                        var btn = other.querySelector('.faq-item__question');
                        if (btn) btn.setAttribute('aria-expanded', 'false');
                    }
                });

                item.classList.toggle('is-open', !isOpen);
                question.setAttribute('aria-expanded', String(!isOpen));
            });
        });

        /* ─── Primary Nav Dropdowns (touch / keyboard) ─────────────────── */
        var dropdownItems = document.querySelectorAll('.primary-nav__item--has-dropdown');

        dropdownItems.forEach(function (item) {
            var link = item.querySelector('.primary-nav__link');
            var caret = link ? link.querySelector('.primary-nav__caret') : null;
            var dropdown = item.querySelector('.primary-nav__dropdown');

            function closeDropdown() {
                if (link) link.setAttribute('aria-expanded', 'false');
                item.classList.remove('is-open');
            }

            link.addEventListener('click', function (event) {
                // Only intercept when the dropdown is open (toggle close),
                // otherwise let the link navigate.
                if (item.classList.contains('is-open')) {
                    event.preventDefault();
                    closeDropdown();
                } else {
                    dropdownItems.forEach(function (other) {
                        if (other !== item) {
                            other.classList.remove('is-open');
                            var btn = other.querySelector('.primary-nav__link');
                            if (btn) btn.setAttribute('aria-expanded', 'false');
                        }
                    });
                    item.classList.add('is-open');
                    link.setAttribute('aria-expanded', 'true');
                }
            });

            document.addEventListener('click', function (event) {
                if (!item.contains(event.target)) {
                    closeDropdown();
                }
            });
        });

        /* ─── Elementor Nav Dropdowns (WordPress-parity pages) ──────────── */
        // The Elementor Pro JS that reveals sub-menus on hover/click does not
        // run in the static export, so drive the dropdowns here: hover shows
        // them on desktop, click toggles them, and the .is-open class (plus a
        // plain CSS :hover rule) reveals the sub-menu.
        var wpMenus = document.querySelectorAll('.elementor-nav-menu--main .elementor-nav-menu');

        wpMenus.forEach(function (menu) {
            var parents = Array.prototype.slice.call(
                menu.querySelectorAll('> li.menu-item-has-children')
            );

            function closeAll(except) {
                parents.forEach(function (li) {
                    if (li !== except) {
                        li.classList.remove('is-open');
                    }
                });
            }

            parents.forEach(function (li) {
                var link = li.querySelector(':scope > a');

                li.addEventListener('mouseenter', function () {
                    closeAll(li);
                    li.classList.add('is-open');
                });
                li.addEventListener('mouseleave', function () {
                    li.classList.remove('is-open');
                });

                // Parent links with a sub-menu only toggle the dropdown (the
                // captured hrefs are dead anchors anyway).
                if (link) {
                    link.addEventListener('click', function (event) {
                        var willOpen = !li.classList.contains('is-open');
                        closeAll(li);
                        li.classList.toggle('is-open', willOpen);
                        event.preventDefault();
                    });
                }
            });

            document.addEventListener('click', function (event) {
                if (!menu.contains(event.target)) {
                    closeAll(null);
                }
            });
        });

        /* ─── Animated Counters (Elementor counter widgets) ─────────────── */
        // The original Elementor counter JS was not captured in the static
        // export, so animate the numbers here: count from data-from-value to
        // data-to-value once the element scrolls into view.
        var counters = document.querySelectorAll('.elementor-counter-number');

        if (counters.length && 'IntersectionObserver' in window) {
            var counterObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;

                    var el = entry.target;
                    counterObserver.unobserve(el);

                    var from = parseInt(el.getAttribute('data-from-value'), 10) || 0;
                    var to = parseInt(el.getAttribute('data-to-value'), 10);
                    var duration = parseInt(el.getAttribute('data-duration'), 10) || 2000;
                    var delimiter = el.getAttribute('data-delimiter') || '';
                    var start = null;

                    if (isNaN(to)) return;

                    function format(value) {
                        var text = String(Math.round(value));
                        if (delimiter) {
                            text = text.replace(/\B(?=(\d{3})+(?!\d))/g, delimiter);
                        }
                        return text;
                    }

                    function tick(timestamp) {
                        if (start === null) start = timestamp;
                        var progress = Math.min((timestamp - start) / duration, 1);
                        var eased = 1 - Math.pow(1 - progress, 3); // easeOutCubic
                        el.textContent = format(from + (to - from) * eased);
                        if (progress < 1) {
                            requestAnimationFrame(tick);
                        }
                    }

                    requestAnimationFrame(tick);
                });
            }, { threshold: 0.3 });

            counters.forEach(function (el) {
                counterObserver.observe(el);
            });
        }
    });
})();
