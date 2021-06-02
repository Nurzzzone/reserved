<template>
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
            <div class="container">
                <a class="navbar-brand text-uppercase font-weight-bold logo-text" href="/">
                    <button class="logo">R</button>eserved
                </a>
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div class="btn-group btn-menu">
                                <a class="nav-link font-weight-bold font-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Русскии</a>
                                <div class="dropdown-menu dropdown-menu-right border-0 shadow rounded-lg">
                                    <button class="dropdown-item font-menu font-menu-item">Казакша</button>
                                    <button class="dropdown-item font-menu font-menu-item">Русскии</button>
                                    <button class="dropdown-item font-menu font-menu-item">English</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="#" class="btn nav-link font-weight-bold font-menu">
                                <div>Войти</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn btn-register nav-link font-weight-bold rounded-100 text-white px-3 font-menu register-btn">
                                <div>Регистрация</div>
                            </a>
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

<style lang="scss">
.btn-menu {
    & > a {
        padding-right: 15px !important;
        position: relative;
        cursor: pointer;
        &:after {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            border: 2px solid #fff;
            border-top: none;
            border-left: none;
            border-radius: 2px;
            right: 0;
            top: 16px;
            transform: rotate(45deg);
        }
    }
}
.btn, .btn-group {
    outline: none;
}
.register-btn {
    border-radius: 100px;
    text-align: center;
}
.font-menu {
    font-size: 14px;
    font-weight: 500;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    & > div {

    }
    &-item {
        color: #000;
        font-weight: normal;
        &:hover, &:active {
            background-color: #4ca1af;
            color: #FFF;
        }
    }
}
.logo {
    font-weight: bold;
    width: 34px;
    height: 34px;
    border-radius: 20px;
    margin: 0 2px 0 0;
    border: none;
    background: #fff;
    color: #2193b0;
    &-blue {
        background: #2193b0;
        color: #fff;
    }
    &-text {
        font-size: 20px;
    }
}
@media only screen and (max-width : 992px) {
    .logo {
        background: #2193b0 !important;
        color: #fff !important;
        &-text {
            color: #2193b0;
        }
    }
}
.btn-register {
    background: #FF8008;
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

}
</style>
