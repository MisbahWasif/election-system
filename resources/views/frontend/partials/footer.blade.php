<footer class="footer">

    <div class="footer-top">

        <div class="col col-brand">
            <div class="logo">
                <img src="{{ asset('images/logo.jpg') }}">
                <div class="logo-text">
                    <span class="line1">Digital</span>
                    <span class="line2">Election System</span>
                </div>
            </div>

            <p class="brand-desc">
                A secure, transparent, and user-friendly platform for modern digital elections.
            </p>

            <div class="social-icons">
                <a href="#" class="social-btn" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn" aria-label="Twitter">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#" class="social-btn" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="#" class="social-btn" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>

        <div class="col col-links">
            <h3 class="col-title">Quick Links</h3>
            <ul class="link-list">
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('home') }}">Home</a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('election') }}">Elections</a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('candidate') }}">Candidates</a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('result') }}">Results</a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('about') }}">About Us</a></li>
                <li><i class="fa-solid fa-angle-right"></i><a href="{{ route('contact') }}">Contact Us</a></li>
            </ul>
        </div>

        <div class="col col-contact">
            <h3 class="col-title">Contact Us</h3>
            <div class="contact-item">
                <i class="fa-solid fa-location-dot"></i>
                <p>123 Democracy Street,<br>Civic Center, Suite 456<br>Capital City, CC 10001</p>
            </div>
            <div class="contact-item">
                <i class="fa-regular fa-envelope"></i>
                <p>info@digitalelection.gov</p>
            </div>
            <div class="contact-item">
                <i class="fa-solid fa-phone"></i>
                <p>+1 (555) 123-4567</p>
            </div>
        </div>

        <div class="col col-newsletter">
            <h3 class="col-title">Newsletter</h3>
            <p class="newsletter-desc">Subscribe to get updates and announcements.</p>
            <div class="newsletter-form">
                <input type="email" placeholder="Enter your email" class="email-input">
                <button class="subscribe-btn">Subscribe</button>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p class="copyright">© 2026 Digital Election System. All rights reserved.</p>
        <div class="bottom-links">
            <a href="#">Privacy Policy</a>
            <span class="separator">|</span>
            <a href="#">Terms of Service</a>
        </div>
    </div>

</footer>