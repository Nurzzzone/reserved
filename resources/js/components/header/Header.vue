<template>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <header class="header">
                    <nav class="navbar navbar-expand-lg fixed-top py-3">
                        <div class="container">
                            <a class="navbar-brand text-uppercase font-weight-bold logo-text" href="/">
                                Reserved
                            </a>
                            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
                            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                                <ul class="navbar-nav ml-auto">
                                    <!--
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
                                    -->
                                    <template v-if="login">
                                        <li class="nav-item mx-3">
                                            <a class="btn nav-link font-weight-bold font-menu" data-toggle="modal" data-target="#auth_modal" @click="storage.auth = true">
                                                <div>Войти</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="btn btn-register nav-link font-weight-bold rounded-100 text-white px-3 font-menu register-btn" data-toggle="modal" data-target="#auth_modal" @click="storage.auth = false">
                                                <div>Регистрация</div>
                                            </a>
                                        </li>
                                    </template>
                                    <template v-else>
                                        <li class="nav-item mx-3 ">
                                            <a href="/home" class="btn nav-link font-weight-bold font-menu d-none d-md-block">
                                                <div>Категории</div>
                                            </a>
                                        </li>
                                        <li class="nav-item mx-3">
                                            <a href="/top" class="btn nav-link font-weight-bold font-menu d-none d-md-block">
                                                <div>Топ</div>
                                            </a>
                                        </li>
                                        <li class="nav-item mx-3">
                                            <a href="/favorite" class="btn nav-link font-weight-bold font-menu d-none d-md-block">
                                                <div>Избранное</div>
                                            </a>
                                        </li>
                                        <li class="ml-3 header-main position-relative">
                                            <div class="header-profile">
                                                <div class="header-profile-main font-weight-bold text-capitalize">
                                                    <div class="header-profile-main-content">
                                                        <div>{{user.name}}</div>
                                                    </div>
                                                </div>
                                                <div class="header-profile-icon">
                                                    <div class="text-white font-weight-bold">{{user.name[0]}}</div>
                                                </div>
                                            </div>
                                            <div class="header-dropdown overflow-hidden">
                                                <div class="list-group list-group-flush header-dropdown-ul">
                                                    <a href="/profile" class="list-group-item text-decoration-none">Мой профиль</a>
                                                    <a href="/profile/settings" class="list-group-item text-decoration-none">Настройки</a>
                                                    <a href="/profile/history" class="list-group-item text-decoration-none">История</a>
                                                    <a class="list-group-item text-decoration-none" @click="exit()">Выйти</a>
                                                </div>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
    </div>
    <Auth></Auth>
</template>

<script>
import Auth from "./auth/Auth";
export default {
    name: "Header",
    components: {
        Auth
    },
    data() {
        return {
            login: false,
            user: {}
        }
    },
    created() {
        this.auth();
    },
    methods: {
        exit: function() {
            this.login  =   true;
            this.storage.token  =   '';
            sessionStorage.user =   '';
            this.user   =   {};
            window.location.href    = '/';
        },
        auth: function() {
            if (this.storage.token) {
                if (sessionStorage.user) {
                    this.user   =   JSON.parse(sessionStorage.user);
                } else {
                    axios.get('/api/token/'+this.storage.token)
                    .then(response => {
                        let data    =   response.data;
                        if (data.hasOwnProperty('data')) {
                            sessionStorage.user =   JSON.stringify(data.data);
                            this.user   =   JSON.parse(sessionStorage.user);
                        }
                    }).catch(error => {
                        this.login   =   true;
                        this.storage.token   =   '';
                    });
                }
            } else {
                this.login   =   true;
            }
        }
    }
}
</script>

<style lang="scss">
.header {
    &-dropdown {
        background: #fff;
        box-shadow: 1px 2px 10px rgba(0, 0, 0, .1);
        position: absolute;
        right: 0;
        width: max-content;
        border-radius: 10px;
        font-size: 14px;
        display: none;
        &-ul {
            & > a {
                cursor: pointer;
                border-color: #f0f0f0;
                color: grey;
                font-weight: bold;
                &:hover {
                    background: #FF8008;
                    color: #fff;

                }
            }
        }
    }
    &-main {
        &:hover > .header-dropdown {
            display: block;
        }
    }
    &-profile {
        display: grid;
        justify-content: center;
        align-content: center;
        grid-template-columns: auto 30px;
        grid-gap: 5px;
        height: 40px;
        font-size: 14px;
        color: #FF8008;
        padding: 0 5px 0 10px;
        background: #fff;
        border-radius: 30px;
        &-main {
            &-content {
                display: grid;
                justify-content: center;
                align-content: center;
                height: 100%;
            }
        }
        &-icon {
            height: 30px;
            width: 30px;
            background: #FF8008;
            border-radius: 30px;
            display: grid;
            justify-content: center;
            align-content: center;
            & > div {
                text-transform: uppercase;
            }
        }
    }
}
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
