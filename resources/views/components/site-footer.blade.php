<footer class="site-footer" role="contentinfo">
    <div class="container">
        <div class="footer__grid">

            {{-- Brand column --}}
            <div class="footer__brand">
                <a href="{{ route('home') }}" class="site-logo" aria-label="Austin Optics">
                    <img src="{{ asset('images/uploads/2026/05/Austin-optics-logo-white-scaled-2.png') }}"
                         alt="Austin Optics" height="30">
                </a>
                <p style="margin-top:1rem;">
                    Austin Optics is committed to delivering expert eye care with a personal touch.
                    From comprehensive exams to custom lenses, we use advanced technology to help you
                    see your best every day.
                </p>
                <address style="font-style:normal;font-size:0.8125rem;margin-bottom:1rem;">
                    Austin Optics<br>
                    72-20 Austin Street<br>
                    Forest Hills, NY 11375<br>
                    <a href="tel:+17182618655" style="color:rgba(255,255,255,0.7);">+1 718-261-8655</a>
                </address>
                <div class="footer__social">
                    <a href="https://www.instagram.com/austinoptics/" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Austin Optics on Instagram">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="https://www.facebook.com/austinoptics" class="footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="Austin Optics on Facebook">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

            {{-- Services column --}}
            <div class="footer__column">
                <h3 class="footer__heading">Services</h3>
                <ul class="footer__links">
                    <li><a href="{{ route('eye-vision-exams') }}">Eye Vision Exams</a></li>
                    <li><a href="{{ route('contact-lens-exams') }}">Contact Lens Exams</a></li>
                    <li><a href="{{ route('hard-to-fit-contact') }}">Hard-to-Fit Contacts</a></li>
                    <li><a href="{{ route('lenses') }}">Lenses</a></li>
                    <li><a href="{{ route('computer-vision') }}">Computer Vision</a></li>
                    <li><a href="{{ route('sunglasses') }}">Sunglasses</a></li>
                </ul>
            </div>

            {{-- Practice column --}}
            <div class="footer__column">
                <h3 class="footer__heading">Practice</h3>
                <ul class="footer__links">
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li><a href="{{ route('meet-the-team') }}">Our Team</a></li>
                    <li><a href="{{ route('insurances') }}">Insurance</a></li>
                    <li><a href="{{ route('frame-selection') }}">Frame Selection</a></li>
                    <li><a href="{{ route('blog') }}">Blog</a></li>
                    <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                </ul>
            </div>

            {{-- Hours column --}}
            <div class="footer__column">
                <h3 class="footer__heading">Hours</h3>
                <div>
                    <div class="footer__hours-row"><span class="day">Tuesday</span>   <span>10am &ndash; 7pm</span></div>
                    <div class="footer__hours-row"><span class="day">Wednesday</span> <span>10am &ndash; 6pm</span></div>
                    <div class="footer__hours-row"><span class="day">Thursday</span>  <span>10am &ndash; 7pm</span></div>
                    <div class="footer__hours-row"><span class="day">Friday</span>    <span>10am &ndash; 6pm</span></div>
                    <div class="footer__hours-row"><span class="day">Saturday</span>  <span>10am &ndash; 5pm</span></div>
                    <div class="footer__hours-row"><span class="day">Sun &ndash; Mon</span> <span>Closed</span></div>
                </div>
            </div>

        </div>

        <div class="footer__bottom">
            <span>&copy; 2026 Austin Optics &middot; 72-20 Austin Street Forest Hills, NY 11375 &middot; Eye care serving Queens and all five NYC boroughs</span>
            <span>Optometrist Forest Hills NY &middot; Eye Doctor Queens</span>
        </div>
    </div>
</footer>
