<template>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content auth-modal">
                <div class="modal-body">
                    <div class="form-group d-flex justify-content-end">
                        <button class="auth-btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-group">
                        <h3 class="auth-title text-center">Войдите</h3>
                        <h6 class="text-secondary text-center mt-3">Войдите или создайте новый аккаунт Reserved.</h6>
                    </div>
                    <div class="form-row mx-3">
                        <div class="col-12 mt-3">
                            <input type="text" class="form-control p-3 auth-input" v-maska="'7##########'" v-model="login.phone" placeholder="Номер телефона" ref="email">
                        </div>
                        <div class="col-12 mt-4">
                            <button class="btn btn-block auth-btn text-white" @click="login_btn">
                                <div v-if="login.status">Далее</div>
                                <div class="spinner" v-else></div>
                            </button>
                        </div>
                        <div class="col-12 mt-4">
                            <button class="btn btn-block auth-register text-white">Регистрация</button>
                        </div>
                    </div>
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
            login: {
                status: true,
                phone: '',
            },
            register: {

            }
        }
    },
    methods: {
        login_btn: function() {
            if (this.value === '') {

            }
        }
    }
}
</script>

<style lang="scss">
    .spinner {
        width: 25px;
        height: 25px;
        border: 4px transparent solid;
        border-top: 4px #fff solid;
        border-bottom: 4px #fff solid;
        border-radius: 50%;
        animation: sp-anime 0.8s infinite linear;
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
