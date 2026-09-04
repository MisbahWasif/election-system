<nav class="navbar">

    <div class="logo">
        <img src="{{ asset('images/logo.jpg') }}">
        Online Election<br> system
    </div>

    <button class="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-links" id="navLinks">

        <li>
            <a class="nav-item" href="{{ route('home') }}">
                <i class="fa-solid fa-house"></i>
                Home
            </a>
        </li>

        <li>
            <a class="nav-item" href="{{ route('election') }}">
                <i class="fa-solid fa-check-to-slot"></i>
                Elections
            </a>
        </li>

        <li>
            <a class="nav-item" href="{{ route('candidate') }}">
                <i class="fa-solid fa-users"></i>
                Candidates
            </a>
        </li>

        <li>
            <a class="nav-item" href="{{ route('result') }}">
                <i class="fa-solid fa-chart-bar"></i>
                Results
            </a>
        </li>

        <li>
            <a class="nav-item" href="{{ route('about') }}">
                <i class="fa-solid fa-circle-info"></i>
                About Us
            </a>
        </li>

        <li>
            <a class="nav-item" href="{{ route('contact') }}">
                <i class="fa-solid fa-phone"></i>
                Contact Us
            </a>
        </li>

        <li>
            <a href="{{ route('voter.login') }}" class="btn-login">
                <i class="fa-regular fa-circle-user"></i>
                Login / Register
            </a>
        </li>

    </ul>

</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById("navLinks");
        if (menu.classList.contains("open")) {
            menu.classList.remove("open");
        } else {
            menu.classList.add("open");
        }
    }
</script>