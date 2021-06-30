<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row mt-5">
                <template v-if="organizations.length > 0">
                    <div class="col-12 col-md-6 col-xl-4 p-2" v-for="(organization,key) in organizations" :key="key">
                        <div class="card border-0 shadow overflow-hidden m-2 item-radius">
                            <div class="item-main">
                                <div class="item-rating">
                                    <span v-if="organization.rating">{{restaurant.rating}}</span>
                                    <span v-else>-</span>
                                </div>
                                <img v-if="organization.wallpaper" :src="organization.wallpaper">
                                <img v-else src="/img/logo/wall.png">
                            </div>
                            <div class="mx-5 item-logo mb-2 d-flex justify-content-center">
                                <img v-if="organization.image" :src="organization.image" width="120">
                                <img v-else src="/img/logo/cafe.svg" width="120">
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center p-0">
                                    <a :href="'/home/'+organization.id" class="text-dark">
                                        <h3 class=" font-weight-bold">{{restaurant.title}}</h3>
                                    </a>
                                    <p class="item-description text-secondary mx-3" v-if="organization.description">{{organization.description}}</p>
                                </li>
                                <li class="list-group-item text-center bg-light">
                                    <div class="h6 text-secondary text-font" v-if="organization.time">{{organization.time}}</div>
                                    <div class="text-center my-2 h6 text-secondary text-font">{{organization.address}}</div>
                                </li>
                                <li class="list-group-item">
                                    <a :href="'/home/'+organization.id" class="btn w-100 text-white text-btn mt-2 text-font font-weight-bold d-flex justify-content-center align-content-center">
                                        <div class="py-1">Подробнее</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 d-flex justify-content-center my-5">
                        <div>
                            <img src="/img/logo/cafe.svg" width="120">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-5">
                        <h2 class="text-center">Список пуст</h2>
                        <p class="text-center h5 text-secondary mt-2">Возможно в данный момент все заведения закрыты. Попробуите обновить страницу позднее.</p>
                    </div>
                </template>
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
    name: "Cafe",
    data() {
        return {
            organizations: []
        }
    },
    created() {
        this.getOrganizations();
    },
    methods: {
        getOrganizations: function()
        {
            axios.get('/api/category/organizations/2')
                .then(response => {
                    let data    =   response.data.data;
                    for (let i = 0; i < data.length; i++) {
                        this.organizations.push(data[i]);
                    }
                });
        }
    }
}
</script>

<style lang="scss">
    @import '../../css/organization/list.scss';
</style>
