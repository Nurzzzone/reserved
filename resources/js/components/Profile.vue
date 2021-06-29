<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <template v-if="user">
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
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Имя</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg profile-input" id="name" v-model="user.name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Телефон</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-lg profile-input" id="phone" v-model="user.phone" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label col-form-label-lg font-weight-bold">Эл.почта</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-lg profile-input" id="email" v-model="user.email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center mt-3">
                                <button type="submit" class="btn profile-btn font-weight-bold text-white px-3  disabled">Сохранить изменения</button>
                            </div>
                        </div>
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
            </template>
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
    name: "Profile",
    data() {
        return {
            user: false,
        }
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser: function () {
            if (this.storage.token && sessionStorage.user) {
                this.user = JSON.parse(sessionStorage.user);
            } else {
                window.location.href = '/home';
            }
        },
    }
}
</script>

<style lang="scss">
    @import '../../css/profile/profile.scss';

    .top {
        &-bg {
            background: #00a082;
        }
        &-title {
            font-family: 'Lobster', cursive;
            margin: 0;
        }
    }
    /*
                font-size: 16px;
            text-align: center;
     */

</style>
