<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex flex-row align-items-end" href="#">
            <img class="rounded mx-auto d-block me-2" src="{{ asset('assets/img/logo/armoiries RDC.png') }}" alt="" srcset="" width="30">
            <span class="fw-bold text-muted h-6">{{ config('app.name') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" id="nav-login-dropdown">
                        
                        <li><a class="dropdown-item" href="{{ route('app_logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Se déconnecter</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>