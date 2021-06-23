<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class=" top-title">Личная информация</h2>
                    <p class="mt-5 h6 text-secondary text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
            </div>
            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-md-8">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Имя</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg profile-input" id="name" value="Azim Tulendiev">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Телефон</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg profile-input" id="phone" value="77787777777" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Эл.почта</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-lg profile-input" id="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center mt-3">
                                <button type="submit" class="btn profile-btn font-weight-bold text-white px-3  disabled">Сохранить изменения</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class=" top-title">Пароль</h2>
                    <p class="mt-5 h6 text-secondary text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
            </div>
            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-md-8">
                    <form>
                        <div class="form-group row">
                            <label for="old" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Старый пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-lg profile-input" id="old">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Новый пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-lg profile-input" id="new" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center mt-3">
                                <button type="submit" class="btn profile-btn font-weight-bold text-white px-3  disabled">Сохранить изменения</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <Footer-menu></Footer-menu>
    <Footer></Footer>
</template>

<script>
import Header from "./header/Header";
import Footer from "./footer/Footer";
import ProfileSection from './sections/ProfileSection';
import FooterMenu from './footerMenu/FooterMenu';
export default {
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu
    },
    name: "Profile"
}
</script>

<style lang="scss">
    .profile {
        &-input {
            border: 2px solid gainsboro;
        }
        &-btn {
            background: #FF8008;
            border-radius: 30px;
            height: 44px;
        }
    }
    .top {
        &-bg {
            background: #00a082;
        }
        &-title {
            font-family: 'Lobster', cursive;
        }
    }
    .avatar {
        overflow: hidden;
        clear: both;
        width: 56px;
        height: 56px;
        display: block;
        &-img {
            width: 100%;
            position: relative;
            float: left;
            color: #00a082;
            & > div {
                font-size: 30px;
                position: absolute;
                transform: translate(-50%,-50%);
                top: 50%;
                left: 50%;
            }
            &:before {
                content: '';
                float: left;
                padding-top: 100%;
            }
        }
    }
</style>
