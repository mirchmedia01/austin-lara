<nav class="mobile-nav" id="mobile-nav" aria-label="Mobile navigation" role="dialog" aria-modal="true">

    <button class="mobile-nav__close" id="mobile-nav-close" aria-label="Close navigation menu">&times;</button>

    <a href="{{ route('home') }}" class="mobile-nav__logo">
        <img src="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2.png') }}" alt="Austin Optics" height="28">
    </a>

    <ul class="mobile-nav__list" role="list">
        <li>
            <a href="{{ route('home') }}" class="mobile-nav__link">Home</a>
        </li>
        <li>
            <a href="{{ route('about-us') }}" class="mobile-nav__link">About Us</a>
            <ul class="mobile-nav__sublist">
                <li><a href="{{ route('about-us') }}"      class="mobile-nav__sublink">About Us</a></li>
                <li><a href="{{ route('awards') }}"        class="mobile-nav__sublink">Awards</a></li>
                <li><a href="{{ route('meet-the-team') }}" class="mobile-nav__sublink">Meet The Team</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ route('services') }}" class="mobile-nav__link">Services</a>
            <ul class="mobile-nav__sublist">
                <li><a href="{{ route('contact-lens-exams') }}"  class="mobile-nav__sublink">Contact Lens Exams</a></li>
                <li><a href="{{ route('eye-vision-exams') }}"    class="mobile-nav__sublink">Eye &amp; Vision Exams</a></li>
                <li><a href="{{ route('hard-to-fit-contact') }}" class="mobile-nav__sublink">Hard-to-Fit Contacts</a></li>
                <li><a href="{{ route('sunglasses') }}"          class="mobile-nav__sublink">Sunglasses</a></li>
                <li><a href="{{ route('computer-vision') }}"     class="mobile-nav__sublink">Computer Vision</a></li>
                <li><a href="{{ route('lenses') }}"              class="mobile-nav__sublink">Lenses</a></li>
            </ul>
        </li>
        <li><a href="{{ route('insurances') }}"     class="mobile-nav__link">Insurances</a></li>
        <li><a href="{{ route('frame-selection') }}" class="mobile-nav__link">Frame Selection</a></li>
        <li><a href="{{ route('best-of-boro') }}"   class="mobile-nav__link">Best of Boro</a></li>
        <li><a href="{{ route('blog') }}"           class="mobile-nav__link">Blog</a></li>
        <li><a href="{{ route('contact-us') }}"     class="mobile-nav__link">Contact Us</a></li>
    </ul>

    <div class="mobile-nav__footer">
        <a href="{{ route('contact-us') }}" class="btn btn--primary btn--lg">Get Started</a>
        <a href="tel:+17182618655" class="btn btn--outline-white btn--lg">Call (718) 261-8655</a>
    </div>

</nav>
