<?php
session_start();
?>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Příspěvky</a>
                    </li>

                    <?php
                    if(isset($_SESSION["username"])) {
                        echo('
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                '.$_SESSION["username"].'
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/logout.php">Odlásit se</a></li>
                            </ul>
                        </li>
                        ');
                    }else{
                        echo ('
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Přihlášení</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register.php">Registrace</a>
                        </li>
                    ');
                    }
                    ?>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</div>
