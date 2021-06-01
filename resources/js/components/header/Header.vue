<template>
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
            <div class="container">
                <a class="navbar-brand text-uppercase font-weight-bold" href="#">
                    <img src="/img/logo/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Reserved
                </a>
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item mx-2">
                            <div class="btn-group " style="padding: .5rem 1rem;">
                                <button type="button" class="btn btn-transparent dropdown-toggle text-white font-weight-bold text-uppercase p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Русскии
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button">Русскии</button>
                                    <button class="dropdown-item" type="button">English</button>
                                    <button class="dropdown-item" type="button">Казакша</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link text-uppercase font-weight-bold">О нас</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link text-uppercase font-weight-bold">Войти</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="btn-register nav-link text-uppercase font-weight-bold rounded text-white px-2">Регистрация</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style>
.btn-register {
    background: orange;
}
.navbar {
    transition: all 0.4s;
}

.navbar .nav-link {
    color: #fff;
}

.navbar .nav-link:hover,
.navbar .nav-link:focus {
    color: #fff;
    text-decoration: none;
}

.navbar .navbar-brand {
    color: #fff;
}


/* Change navbar styling on scroll */
.navbar.active {
    background: #fff;
    box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar.active .nav-link {
    color: #555;
}

.navbar.active .nav-link:hover,
.navbar.active .nav-link:focus {
    color: #555;
    text-decoration: none;
}

.navbar.active .navbar-brand {
    color: #555;
}


/* Change navbar styling on small viewports */
@media (max-width: 991.98px) {
    .navbar {
        background: #fff;
    }

    .navbar .navbar-brand, .navbar .nav-link {
        color: #555;
    }
}



/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
.text-small {
    font-size: 0.9rem !important;
}


body {
    min-height: 110vh;
    background-color: #4ca1af;
    background-image: linear-gradient(135deg, #4ca1af 0%, #c4e0e5 100%);
}
</style>
