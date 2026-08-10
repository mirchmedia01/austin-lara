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

        function openNav() {
            if (!nav) return;
            nav.classList.add('is-open');
            nav.setAttribute('aria-hidden', 'false');
            if (toggle) {
                toggle.classList.add('is-open');
                toggle.setAttribute('aria-expanded', 'true');
            }
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
    });
})();
