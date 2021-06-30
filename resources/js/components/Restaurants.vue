<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-md-5 item-bg">
        <div class="container">
            <div class="row mt-md-5">
                <template v-if="restaurants.length > 0">
                    <div class="col-6 col-xl-4 p-0 p-md-2" v-for="(restaurant,key) in restaurants" :key="key">
                        <div class="card border-0 item-shadow overflow-hidden m-2 m-md-0 item-radius">
                            <div class="item-main">
                                <div class="item-rating">
                                    <span v-if="restaurant.rating">{{restaurant.rating}}</span>
                                    <span v-else>-</span>
                                </div>
                                <img v-if="restaurant.wallpaper" :src="restaurant.wallpaper">
                                <img v-else src="/img/logo/wall.png">
                            </div>
                            <div class="item-logo mb-md-2 d-flex justify-content-center">
                                <img v-if="restaurant.image" :src="restaurant.image">
                                <img v-else src="/img/logo/restaurant.svg">
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center p-0">
                                    <a :href="'/home/'+restaurant.id" class="text-dark">
                                        <h3 class=" font-weight-bold item-title">{{restaurant.title}}</h3>
                                    </a>
                                    <p class="item-description text-secondary mx-3" v-if="restaurant.description">{{restaurant.description}}</p>
                                </li>
                                <li class="list-group-item text-center bg-light">
                                    <div class="h6 text-secondary text-font" v-if="restaurant.time">{{restaurant.time}}</div>
                                    <div class="text-center my-2 h6 text-secondary text-font">{{restaurant.address}}</div>
                                </li>
                                <li class="list-group-item">
                                    <a :href="'/home/'+restaurant.id" class="btn w-100 text-white text-btn mt-2 text-font font-weight-bold d-flex justify-content-center align-content-center">
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
                            <img src="/img/logo/restaurant.svg" width="120">
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
    name: "Restaurants",
    data() {
        return {
            restaurants: []
        }
    },
    created() {
        this.getRestaurants();
    },
    methods: {
        getRestaurants: function()
        {
            axios.get('/api/category/organizations/1')
            .then(response => {
                let data    =   response.data.data;
                for (let i = 0; i < data.length; i++) {
                    this.restaurants.push(data[i]);
                    this.restaurants.push(data[i]);
                    this.restaurants.push(data[i]);
                    this.restaurants.push(data[i]);
                }
            });
        }
    }
}
</script>

<style lang="scss">
    @import '../../css/organization/list.scss';
</style>
