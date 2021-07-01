<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid py-3 py-md-5 item-bg">
        <div class="container">
            <div class="row">
                <template v-if="restaurants.length > 0">
                    <div class="col-6 col-xl-4 p-0 p-md-2" v-for="(restaurant,key) in restaurants" :key="key">
                        <div class="card border-0 item-shadow overflow-hidden m-2 m-md-0 item-radius">
                            <div class="item-main">
                                <div class="favorite-category" :class="{'favorite-main-off':(!storage.favorite.includes(restaurant.id)),'favorite-main-on':(storage.favorite.includes(restaurant.id))}" @click="favorite(restaurant.id)"></div>
                                <div class="item-rating" v-if="restaurant.rating">
                                    <span>{{restaurant.rating}}</span>
                                </div>
                                <img v-if="restaurant.wallpaper" :src="restaurant.wallpaper">
                                <img v-else src="/img/logo/wall.png">
                            </div>
                            <div class="item-logo mb-md-2 d-flex justify-content-center">
                                <div class="item-logo-default">
                                    <img v-if="restaurant.image" :src="restaurant.image">
                                    <div style="background-image: url('/img/logo/restaurant.svg')"></div>
                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center p-0">
                                    <a :href="'/home/'+restaurant.id" class="text-dark">
                                        <h3 class=" font-weight-bold item-title">{{restaurant.title}}</h3>
                                    </a>
                                    <p class="item-description text-secondary mx-3 my-0" v-if="restaurant.description">{{restaurant.description}}</p>
                                </li>
                                <li class="list-group-item text-center bg-light">
                                    <div class="h6 text-secondary text-font" v-if="restaurant.timeTitle">{{restaurant.timeTitle}}</div>
                                    <div class="text-center mb-0 mt-2 h6 text-secondary text-font">{{restaurant.address}}</div>
                                </li>
                                <li class="list-group-item">
                                    <a :href="'/home/'+restaurant.id" class="btn w-100 text-white text-btn text-font font-weight-bold d-flex justify-content-center align-content-center">
                                        <div class="py-md-1">Подробнее</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="col-12 d-flex justify-content-center my-5">
                        <div>
                            <img src="/img/logo/restaurant.svg" width="100">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-5">
                        <h2 class="text-center item-empty-title">Список пуст</h2>
                        <p class="text-center text-secondary mt-2 item-empty-description">Возможно в данный момент все заведения закрыты. Попробуите обновить страницу позднее.</p>
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
        favorite: function(id) {
            let len =   this.storage.favorite.length;
            let status  =   true;
            for (let i = 0; i < len; i++) {
                if (this.storage.favorite[i] === id) {
                    this.storage.favorite.splice(i,1);
                    status  =   false;
                }
            }
            if (status) {
                this.storage.favorite.push(id);
            }
        },
        getRestaurants: function() {
            axios.get('/api/category/organizations/1')
            .then(response => {
                let data    =   response.data.data;
                for (let i = 0; i < data.length; i++) {
                    data[i].timeTitle   =   this.getTime(data[i]);
                    this.restaurants.push(data[i]);
                }
            });
        },
        getTime: function(organization) {
            let today   =   new Date();
            today       =   new Date(today.getFullYear(),today.getMonth(),today.getDate());
            let weekDay =   today.getDay();
            let week;
            if (weekDay === 0) {
                week    =   organization.sunday;
            } else if (weekDay === 1) {
                week    =   organization.monday;
            } else if (weekDay === 2) {
                week    =   organization.tuesday;
            } else if (weekDay === 3) {
                week    =   organization.wednesday;
            } else if (weekDay === 4) {
                week    =   organization.thursday;
            } else if (weekDay === 5) {
                week    =   organization.friday;
            } else if (weekDay === 6) {
                week    =   organization.saturday;
            }
            if (week.start === week.end) {
                return 'круглосуточно';
            }
            return this.timeConvert(week.start)+' '+this.timeConvert(week.end);
        },
        timeConvert: function(time) {
            let converted   =   time.split(':');
            return converted[0]+'.'+converted[1];
        },
    }
}
</script>

<style lang="scss">
    @import '../../css/favorite/favorite.scss';
    @import '../../css/organization/list.scss';
</style>
