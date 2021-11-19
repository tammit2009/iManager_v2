<nav class="navbar navbar-expand-lg navbar-light navbarMain">
    <div class="container">

        <a class="navbar-brand d-flex" href="#">
            <img src="./assets/imgs/imanager_logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
            <h3 class="pl-2">iManager</h3>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mx-5 d-flex justify-content-between">
            <ul class="navbar-nav" id="linksBar">
                <li class="nav-item active mx-3">
                    <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <!-- Access the correct dashboard by user role -->
                    <!-- <a class="nav-link" href="./dashboard.php">About</a> -->
                    <a class="nav-link" href="./dashboard.php?page=index">Dashboard</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="./about.php">About</a>
                </li>
            </ul>
            <ul class="navbar-nav float-right" id="accessBar">
                <li class="nav-item px-2">
                    <a class="nav-link" href="./auth.php?page=login">Login</a>
                </li>
                <!-- <div style="padding-top: 6px;">|</div> -->
                <li class="nav-item px-2">
                    <a class="nav-link" href="./auth.php?page=register">Register</a>
                </li>
                <!-- <div style="padding-top: 6px;">|</div> -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="accessMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Help
                    </a>
                    <div class="dropdown-menu" aria-labelledby="accessMenuLink">
                        <a class="dropdown-item" href="auth.php?page=validate_email">Validate Email</a>
                        <a class="dropdown-item" href="auth.php?page=reset_password">Reset Password</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>