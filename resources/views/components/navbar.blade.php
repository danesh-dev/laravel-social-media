<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-globe"></i> Social Media</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item"><a class="nav-link" href="/posts/create"><i class="fas fa-plus-circle"></i> New Post</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-envelope"></i> Messages</a></li>
                <li class="nav-item"><a class="nav-link" href="/"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item dropdown-center">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i> {{auth()->user()->username}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">My Posts</a></li>
                        <li><a class="dropdown-item" href="#">Edit Account</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('showLogin') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('showRegister') }}"><i class="fas fa-user-plus"></i> Register</a></li>
            @endauth
        </ul>
    </div>
</nav>
