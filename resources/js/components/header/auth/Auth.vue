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
                        <h6 class="text-secondary text-center mt-3">Войдите или создайте новый аккаунт Wolt.</h6>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control p-3 auth-input" placeholder="Номер телефона">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Auth"
}
</script>

<style lang="scss">
    .auth {
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
