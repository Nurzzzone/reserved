<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class=" top-title">Местонахождение</h2>
                    <p class="mt-5 h6 text-secondary text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center">
                            <div>
                                <div class="h5 font-weight-bold">Язык</div>
                                <p class="h6 text-secondary">Выберите желаемый язык. Список товаров может всё же отображаться на разных языках.</p>
                            </div>
                            <div class="d-flex">
                                <select class="form-control form-control-lg" aria-label="Default select example">
                                    <option value="1">Русский</option>
                                    <option value="2">Казахскии</option>
                                    <option value="3">English</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center">
                            <div>
                                <div class="h5 font-weight-bold">Страна</div>
                                <p class="h6 text-secondary">Выбранная страна определяет валюту вашего пригласительного кода</p>
                            </div>
                            <div>
                                <select class="form-control form-control-lg" aria-label="Default select example">
                                    <option value="1">Казахстан</option>
                                    <option value="2">Россия</option>
                                    <option value="3">Кыргызстан</option>
                                    <option value="4">Украина</option>
                                </select>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-content-center">
                            <div>
                                <div class="h5 font-weight-bold">Push Уведомление</div>
                                <p class="h6 text-secondary">Получать маркетинговые уведомление</p>
                            </div>
                            <div>
                                <div class="border border-secondary rounded-lg d-flex justify-content-end settings-form settings-form-active">
                                    <button class="btn btn-lg settings-btn border-0 shadow-sm"></button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-content-center">
                            <div>
                                <div class="h5 font-weight-bold">Email Уведомление</div>
                                <p class="h6 text-secondary">Отправлять чеки на почту</p>
                            </div>
                            <div>
                                <div class="border border-secondary rounded-lg d-flex justify-content-end settings-form settings-form-active">
                                    <button class="btn btn-lg settings-btn border-0 shadow-sm"></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class=" top-title">Сессия</h2>
                    <p class="mt-5 h6 text-secondary text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-content-center">
                            <div>
                                <div class="h5 font-weight-bold">iPhone</div>
                                <p class="h6 text-secondary">Казахстан, Алматы GMT+3</p>
                            </div>
                            <div>
                                <button class="btn settings-btn-bg font-weight-bold text-white px-3">Завершить сеанс</button>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-content-center">
                            <div>
                                <div class="h5 font-weight-bold">Android</div>
                                <p class="h6 text-secondary">Казахстан, Алматы GMT+3</p>
                            </div>
                            <div>
                                <button class="btn settings-btn-bg font-weight-bold text-white px-3">Завершить сеанс</button>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-content-center">
                            <div>
                                <div class="h5 font-weight-bold">Android</div>
                                <p class="h6 text-secondary">Казахстан, Алматы GMT+3</p>
                            </div>
                            <div>
                                <button class="btn settings-btn-bg font-weight-bold text-white px-3">Завершить сеанс</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>

<script>
import Header from "./header/Header";
import Footer from "./footer/Footer";
import ProfileSection from "./sections/ProfileSection";
export default {
    name: "Settings",
    components: {
        Header,
        Footer,
        ProfileSection
    }
}
</script>

<style lang="scss">
    .settings {
        &-form {
            width: 96px;
            padding: 4px;
            &-active {
                background: #00a082;
            }
        }
        &-btn {
            height: 40px;
            width: 40px;
            background: #fff;
            &-bg {
                background: #FF8008;
                border-radius: 30px;
                height: 44px;
            }
        }
        &-item {

        }
    }
</style>
