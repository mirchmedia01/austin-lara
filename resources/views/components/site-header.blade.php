<header class="site-header" id="site-header" role="banner">
    <div class="container">
        <div class="site-header__inner">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="site-logo" aria-label="Austin Optics — Home">
                <img src="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2.png') }}"
                     alt="Austin Optics"
                     width="180" height="24"
                     loading="eager">
            </a>

            {{-- Primary Navigation --}}
            <nav class="primary-nav" aria-label="Primary navigation">
                <ul class="primary-nav__list" role="list">

                    <li class="primary-nav__item">
                        <a href="{{ route('home') }}"
                           class="primary-nav__link {{ request()->routeIs('home') ? 'is-active' : '' }}">
                            Home
                        </a>
                    </li>

                    <li class="primary-nav__item primary-nav__item--has-dropdown">
                        <a href="{{ route('about-us') }}"
                           class="primary-nav__link primary-nav__link--has-caret {{ request()->routeIs('about-us','awards','meet-the-team') ? 'is-active' : '' }}"
                           aria-haspopup="true" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="primary-nav__dropdown" role="list">
                            <li><a href="{{ route('about-us') }}"       class="primary-nav__dropdown-link">About Us</a></li>
                            <li><a href="{{ route('awards') }}"         class="primary-nav__dropdown-link">Awards</a></li>
                            <li><a href="{{ route('meet-the-team') }}"  class="primary-nav__dropdown-link">Meet The Team</a></li>
                        </ul>
                    </li>

                    <li class="primary-nav__item primary-nav__item--has-dropdown">
                        <a href="{{ route('services') }}"
                           class="primary-nav__link primary-nav__link--has-caret {{ request()->routeIs('services','contact-lens-exams','eye-vision-exams','hard-to-fit-contact','sunglasses','computer-vision','lenses') ? 'is-active' : '' }}"
                           aria-haspopup="true" aria-expanded="false">
                            Services
                        </a>
                        <ul class="primary-nav__dropdown" role="list">
                            <li><a href="{{ route('contact-lens-exams') }}" class="primary-nav__dropdown-link">Contact Lens Exams</a></li>
                            <li><a href="{{ route('eye-vision-exams') }}"   class="primary-nav__dropdown-link">Eye &amp; Vision Exams</a></li>
                            <li><a href="{{ route('hard-to-fit-contact') }}" class="primary-nav__dropdown-link">Hard-to-Fit Contacts</a></li>
                            <li><a href="{{ route('sunglasses') }}"         class="primary-nav__dropdown-link">Sunglasses</a></li>
                            <li><a href="{{ route('computer-vision') }}"    class="primary-nav__dropdown-link">Computer Vision</a></li>
                            <li><a href="{{ route('lenses') }}"             class="primary-nav__dropdown-link">Lenses</a></li>
                        </ul>
                    </li>

                    <li class="primary-nav__item">
                        <a href="{{ route('insurances') }}"
                           class="primary-nav__link {{ request()->routeIs('insurances') ? 'is-active' : '' }}">
                            Insurances
                        </a>
                    </li>

                    <li class="primary-nav__item">
                        <a href="{{ route('frame-selection') }}"
                           class="primary-nav__link {{ request()->routeIs('frame-selection') ? 'is-active' : '' }}">
                            Frame Selection
                        </a>
                    </li>

                    <li class="primary-nav__item">
                        <a href="{{ route('best-of-boro') }}"
                           class="primary-nav__link {{ request()->routeIs('best-of-boro') ? 'is-active' : '' }}">
                            Boro
                        </a>
                    </li>

                    <li class="primary-nav__item">
                        <a href="{{ route('blog') }}"
                           class="primary-nav__link {{ request()->routeIs('blog','blog.post') ? 'is-active' : '' }}">
                            Blog
                        </a>
                    </li>

                    <li class="primary-nav__item">
                        <a href="{{ route('contact-us') }}"
                           class="primary-nav__link {{ request()->routeIs('contact-us') ? 'is-active' : '' }}">
                            Contact Us
                        </a>
                    </li>

                </ul>
            </nav>

            {{-- CTA button --}}
            <div class="site-header__cta" style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                <a href="tel:+17182618655" class="nav-cta-btn"><i class="fas fa-phone-alt" aria-hidden="true"></i> Get Started Now</a>
                <button class="mobile-menu-toggle"
                        id="mobile-menu-toggle"
                        aria-label="Open navigation menu"
                        aria-expanded="false"
                        aria-controls="mobile-nav">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

        </div>
    </div>
</header>
