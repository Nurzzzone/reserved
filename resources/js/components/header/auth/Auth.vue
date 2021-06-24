<template>
    <div class="modal fade" id="auth_modal" tabindex="-1" role="dialog" aria-labelledby="auth_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content auth-modal">
                <div class="modal-body">
                    <div class="form-group d-flex justify-content-end">
                        <button class="auth-btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <template v-if="sms.check">
                        <div class="form-group">
                            <h3 class="auth-title text-center">Смс подтверждение</h3>
                            <h6 class="text-secondary text-center mt-3">На ваш номер был отправлен смс код.</h6>
                        </div>
                        <div class="form-group p-0" v-if="sms.error">
                            <div class="auth-error font-weight-bold text-center">Не код правильный код подтверждения.</div>
                        </div>
                        <div class="form-row mx-3">
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control p-3 auth-input" v-maska="'######'" v-model="sms.code" placeholder="код смс" ref="phone_code">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-btn text-white" @click="sms_btn">
                                    <div v-if="sms.status">Подтвердить номер</div>
                                    <div class="spinner" v-else></div>
                                </button>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-register text-white" @click="cancelSms()">Отмена</button>
                            </div>
                        </div>
                    </template>
                    <template v-else-if="storage.auth">
                        <div class="form-group">
                            <h3 class="auth-title text-center">Войдите</h3>
                            <h6 class="text-secondary text-center mt-3">Войдите или создайте новый аккаунт Reserved.</h6>
                        </div>
                        <div class="form-group p-0" v-if="login.error">
                            <div class="auth-error font-weight-bold text-center">Не правильный логин или пароль.</div>
                        </div>
                        <div class="form-row mx-3">
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control p-3 auth-input" v-maska="'7##########'" v-model="login.phone" placeholder="Номер телефона" ref="phone">
                            </div>
                            <div class="col-12 mt-3">
                                <input type="password" class="form-control p-3 auth-input" v-model="login.password" placeholder="Пароль" ref="password">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-btn text-white" @click="login_btn">
                                    <div v-if="login.status">Далее</div>
                                    <div class="spinner" v-else></div>
                                </button>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-register text-white" @click="storage.auth = false">Регистрация</button>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="form-group">
                            <h3 class="auth-title text-center">Регистрация</h3>
                            <h6 class="text-secondary text-center mt-3">Войдите или создайте новый аккаунт Reserved.</h6>
                        </div>
                        <div class="form-group p-0" v-if="register.error">
                            <div class="auth-error font-weight-bold text-center" v-html="register.error_message"></div>
                        </div>
                        <div class="form-row mx-3">
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control p-3 auth-input" v-model="register.name" placeholder="Ваше имя" ref="name_register">
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control p-3 auth-input" v-maska="'7##########'" v-model="register.phone" placeholder="Номер телефона" ref="phone_register">
                            </div>
                            <div class="col-12 mt-3">
                                <input type="password" class="form-control p-3 auth-input" v-model="register.password" placeholder="Пароль" ref="password_register">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-btn text-white" @click="register_btn">
                                    <div v-if="register.status">Регистрация</div>
                                    <div class="spinner" v-else></div>
                                </button>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-register text-white" @click="storage.auth = true">Войти</button>
                            </div>
                        </div>
                    </template>
                    <div class="form-row mt-4">
                        <div class="col-12">
                            <p class="text-secondary auth-txt text-center">
                                На сайте применяются Политика Конфиденциальности и Условия Пользования
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { maska } from 'maska'
export default {
    directives: { maska },
    name: "Auth",
    data: function() {
        return {
            sms: {
                check: false,
                status: false,
                error: false,
                code: '',
                phone: '',
            },
            login: {
                error: false,
                status: true,
                phone: '',
                password: '',
            },
            register: {
                error: false,
                error_message: '',
                status: true,
                name: '',
                phone: '',
                password: '',
            },
        }
    },
    methods: {
        cancelSms: function() {
            this.sms.check    =   false;
            this.sms.error    =   false;
            this.sms.status   =   false;
            this.sms.phone    = '';
            this.login.status   =   true;
            this.login.error    =   false;
            this.register.status   =   true;
            this.register.error    =   false;
        },
        sms_btn: function() {
            if (!this.storage.token) {
                if (this.sms.status) {
                    if (this.sms.phone.trim() === '') {
                        return this.$refs.phone_code.focus();
                    }
                    this.sms.error    =   false;
                    this.sms.status   =   false;
                    axios.get('/api/sms/'+this.sms.phone+'/'+this.sms.code)
                    .then(response => {
                        let data    =   response.data;
                        if (data.hasOwnProperty('data')) {
                            this.storage.token  =   data.data.api_token;
                            sessionStorage.user =   JSON.stringify(data.data);
                            window.location.href = '/home';
                        }
                    }).catch(error => {
                        this.sms.status   =   true;
                        this.sms.error    =   true;
                    });

                }
            }
        },
        register_btn: function() {
            if (!this.storage.token) {
                if (this.register.status) {
                    if (this.register.name.trim() === '') {
                        return this.$refs.name_register.focus();
                    } if (this.register.phone.trim() === '') {
                        return this.$refs.phone_register.focus();
                    } else if (this.register.password.trim() === '') {
                        return this.$refs.password_register.focus();
                    }
                    this.register.error    =   false;
                    this.register.status   =   false;
                    let data = {
                        name: this.register.name.trim(),
                        phone: this.register.phone.trim(),
                        password: this.register.password.trim()
                    };
                    axios.post("/api/register", data)
                    .then(response => {
                        let data = response.data;
                        if (data.hasOwnProperty('data')) {
                            if (data.data.phone_verified_at === 'Не подтвержден' || data.data.phone_verified_at === 'Not verified') {
                                this.sms.check = true;
                                this.sms.phone = data.data.phone;
                                this.sms.status = true;
                            }
                        }
                    }).catch(error => {
                        this.register.error_message = '';
                        for (let prop in error.response.data.errors) {
                            for (let i = 0; i < error.response.data.errors[prop].length; i++) {
                                this.register.error_message += error.response.data.errors[prop][i];
                            }
                        }
                        this.register.status   =   true;
                        this.register.error    =   true;
                    });
                }
            } else {
                window.location.reload();
            }
        },
        login_btn: function() {
            if (!this.storage.token) {
                if (this.login.status) {
                    if (this.login.phone.trim() === '') {
                        return this.$refs.phone.focus();
                    } else if (this.login.password.trim() === '') {
                        return this.$refs.password.focus();
                    }
                    this.login.error    =   false;
                    this.login.status   =   false;
                    axios.get('/api/login/'+this.login.phone+'/'+this.login.password)
                    .then(response => {
                        let data    =   response.data;
                        if (data.hasOwnProperty('data')) {
                            if (data.data.phone_verified_at === 'Не подтвержден' || data.data.phone_verified_at === 'Not verified') {
                                this.sms.check = true;
                                this.sms.status = true;
                                this.sms.phone = data.data.phone;
                            } else {
                                this.storage.token  =   data.data.api_token;
                                sessionStorage.user =   JSON.stringify(data.data);
                                this.login.error    =   false;
                                window.location.href = '/home';
                            }
                        }
                    }).catch(error => {
                        this.login.status   =   true;
                        this.login.error    =   true;
                    });
                }
            } else {
                window.location.reload();
            }
        }
    }
}
</script>

<style lang="scss">
    .auth {
        &-error {
            color: red;
        }
    }
    .spinner {
        width: 25px;
        height: 25px;
        border: 4px transparent solid;
        border-top: 4px #fff solid;
        border-bottom: 4px #fff solid;
        border-radius: 50%;
        animation: sp-anime 0.5s infinite linear;
        margin: 0 auto 0 auto;
    }
    @keyframes sp-anime {
        100% {
            transform: rotate(360deg);
        }
    }
    .auth {
        &-txt {
            font-size: 13px;
        }
        &-btn, &-register {
            height: 44px;
            background: #FF8008;
            border-radius: 40px;
        }
        &-register {
            background: #00a082;
        }
        &-input {
            height: 44px;
            border: 2px solid gainsboro;
        }
        &-title {
            font-family: 'Lobster', cursive;
        }
        &-modal {
            border-radius: 20px;
        }
        &-btn {
            &-close {
                width: 40px;
                height: 40px;
                background: gainsboro;
                outline: none;
                border: none;
                border-radius: 40px;
                position: relative;
                display: grid !important;
                &:before, &:after {
                    content: '';
                    position: absolute;
                    width: 20px;
                    height: 1px;
                    background: #000;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%,-50%) rotate(
                            45deg
                    );
                }
                &:after {
                    transform: translate(-50%,-50%) rotate(
                            -45deg
                    );
                }
            }
        }
    }
</style>
