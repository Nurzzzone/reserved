<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid p-0 m-0 form-bg-color">
        <div class="container p-0">
            <div class="form">
                <div class="form-main">
                    <div class="container-fluid p-0 m-0">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-left">
                                    <div>
                                        <div class="form-left-title">Заявка</div>
                                        <div class="form-left-description">Заполните форму чтобы стать членом Reserved</div>
                                        <div class="form-left-input">
                                            <div class="form-left-input-title">Ваше имя</div>
                                            <input type="text" class="form-left-input-text" value="Azim" readonly>
                                        </div>
                                        <div class="form-left-input">
                                            <div class="form-left-input-title">Ваш номер телефона</div>
                                            <input type="text" class="form-left-input-text" value="+7">
                                        </div>
                                        <div class="form-left-input">
                                            <div class="form-left-input-title">Название заведения</div>
                                            <input type="text" class="form-left-input-text" value="">
                                        </div>
                                        <div class="form-left-input-double">
                                            <div class="form-left-input form-left-input-split">
                                                <div class="form-left-input-title">Тип заведения</div>
                                                <select class="form-left-input-select">
                                                    <option v-for="(category,key) in categories" :key="key" :value="category.id">{{category.title}}</option>
                                                </select>
                                            </div>
                                            <div class="form-left-input form-left-input-split">
                                                <div class="form-left-input-title">Город</div>
                                                <select class="form-left-input-select">
                                                    <option>Выберите Город</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-left-input-desc" onselectstart="return false">
                                            <input type="checkbox" id="scales" class="form-left-checkbox">
                                            <label for="scales" class="form-left-label">Настоящим подтверждаю, что я ознакомлен и согласен с условиями политики конфиденциальности.</label>
                                        </div>
                                        <div class="form-left-input">
                                            <button class="form-left-button">Оставить заявку</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-right">
                                    <div class="form-right-wallpaper"></div>
                                    <div class="form-right-shadow"></div>
                                    <div class="form-right-content">
                                        <div class="form-icon"></div>
                                        <div class="form-icons">
                                            <div class="form-item"></div>
                                            <div class="form-item"></div>
                                            <div class="form-item"></div>
                                        </div>
                                        <div class="form-title">Станьте членом Reserved. Наш сервис упрощяет жизни миллионам людей. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    name: "Form",
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
    },
    data() {
        return {
            categories: [],
            cities: [],
        }
    },
    created() {
        this.getOrganizations();
        this.getCities();
    },
    methods: {
        getOrganizations: function() {
            axios.get('/api/category/list')
                .then(response => {
                    this.categories =   response.data.data;
                }).catch(error => {
                    //this.getOrganizations();
                });
        },
        getCities: function() {
            axios.get('/api/countries')
                .then(response => {
                    let data    =   response.data.data;
                    data.foreach(element => {
                        console.log(element);
                    });
                }).catch(error => {
                    this.getCities();
                });
        }
    }
}
</script>

<style lang="scss">
    .form {
        min-height: 300px;
        &-title {
            text-align: center;
            margin: 30px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
        }
        &-item {
            width: 40px;
            height: 40px;
            background: #00a082 no-repeat center;
            box-shadow: 0 0 0 5px #fff;
            border-radius: 50px;
            background-size: 50%;
            margin: 0 auto 0 auto;
            &:first-child {
                background-image: url('/img/logo/restaurant.svg');
            }
            &:nth-child(2) {
                background-image: url('/img/logo/cafe.svg');
            }
            &:nth-child(3) {
                background-image: url('/img/logo/bar.svg');
            }
        }
        &-icons {
            width: 190px;
            display: flex;
            justify-content: space-between;
            margin: 40px auto 0 auto;
        }
        &-icon {
            background: url(/img/logo/reserved-logo.png) #fff no-repeat center;
            background-size: contain;
            width: 190px;
            height: 190px;
            margin: 20px auto 0 auto;
            box-shadow: 0 0 0 5px #fff;
            border-radius: 190px;
        }
        &-left {
            &-button {
                float: right;
                height: 40px;
                font-size: 14px;
                color: white;
                padding: 0 15px 0 15px;
                border-radius: 30px;
                border: none;
                background: #00a082;
            }
            &-checkbox {
                margin: 4px 0 0 0;
            }
            &-label {
                margin: 0;
                cursor: pointer;
            }
            &-title {
                font-size: 40px;
                font-weight: bold;
                color: #000;
                margin: 50px 0 0 50px;
            }
            &-description {
                margin: 0 0 0 50px;
                font-size: 14px;
                color: grey;
            }
            &-input {
                margin: 15px 50px 0 50px;
                &-double {
                    display: flex;
                    gap: 20px;
                    margin: 15px 50px 0 50px;
                }
                &-title {
                    font-size: 12px;
                    color: grey;
                }
                &-text {
                    width: 100%;
                    height: 35px;
                    padding: 5px 0 5px 0;
                    font-size: 14px;
                    border: none;
                    border-bottom: 1px solid gainsboro;
                    outline: none;
                }
                &-split {
                    margin: 0;
                    flex-grow: 1;
                }
                &-desc {
                    margin: 15px 50px 0 50px;
                    font-size: 12px;
                    color: grey;
                    display: flex;
                    gap: 15px;
                }
                &-select {
                    border: none;
                    border-bottom: 1px solid gainsboro;
                    outline: none;
                    width: 100%;
                    height: 35px;
                    font-size: 14px;
                    background: transparent;
                    padding: 0 !important;
                    cursor: pointer;
                }
            }
        }
        &-right {
            height: 560px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            margin: 20px 20px 20px 0;
            border-radius: 5px;
            &-wallpaper {
                position: absolute;
                width: 110%;
                height: 110%;
                background: url(/img/main/img-15.jpg) no-repeat center;
                background-size: cover;
                filter: blur(5px);
                margin: -10px 0 0 -10px;
            }
            &-shadow {
                position: absolute;
                z-index: 1;
                width: 100%;
                height: 100%;
                background: #000;
                opacity: .8;
            }
            &-content {
                position: relative;
                z-index: 2;
            }
        }
        &-main {
            background: #fff;
            position: relative;
            top: -50px;
            z-index: 2;
            height: 600px;
            border-radius: 10px;
            box-shadow: 0 0 5px 0 rgba(0,0,0,.3);
            overflow: hidden;
        }
        &-bg {
            background: no-repeat center;
            background-size: cover;
            &-color {
                background: rgb(245,245,245);
            }
        }
    }
</style>
