<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-globe"></i> Social Media</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('new-post') }}"><i class="fas fa-plus-circle"></i>
                    New Post</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-envelope"></i> Messages</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}"> My Profile</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="true">
                    <i class="fas fa-user"></i> Account
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">my profile</a></li>
                    <li><a class="dropdown-item" href="#">my posts</a></li>
                    <li><a class="dropdown-item" href="#">edit account</a></li>
                    <li><a class="dropdown-item" href="#">logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
