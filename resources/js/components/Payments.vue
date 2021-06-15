<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <h2 class=" top-title">Ваши карточки</h2>
                    <p class="mt-5 h6 text-secondary text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center">
                            <div class="d-flex">
                                <div class="payments-card-icon payments-card-icon-visa mr-3"></div>
                                <div>
                                    <div class="h5 font-weight-bold">Карта 1</div>
                                    <p class="h6 text-secondary">426343******9479.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary">Удалить</button>
                                    <button type="button" class="btn btn-outline-secondary">Редактировать</button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center">
                            <div class="d-flex">
                                <div class="payments-card-icon payments-card-icon-visa mr-3"></div>
                                <div>
                                    <div class="h5 font-weight-bold">Карта 1</div>
                                    <p class="h6 text-secondary">426343******9479.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                    <button type="button" class="btn btn-outline-secondary">Удалить</button>
                                    <button type="button" class="btn btn-outline-secondary">Редактировать</button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-12 d-flex justify-content-center align-content-center mt-3">
                    <button class="btn text-white payments-btn">Добавить карточку</button>
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
    name: "Payments",
    components: {
        Header,
        Footer,
        ProfileSection
    }
}
</script>

<style lang="scss">
    .payments {
        &-btn {
            background-color: #FF8008;
            color: #fff;
            border-radius: 30px;
            height: 44px;
            padding: 0 30px 0 30px;
        }
        &-card {
            &-icon {
                width: 44px;
                height: 44px;
                &-visa {
                    background: url("/img/logo/visa.png") no-repeat center;
                    background-size: contain;
                }
            }
        }
    }
</style>
