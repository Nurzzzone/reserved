<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid py-3 py-md-5 item-bg">
        <div class="container">
            <div class="row">
                <template v-if="list.length > 0">
                    <div class="col-6 col-xl-4 p-0 p-md-2" v-for="(organization,key) in list" :key="key">
                        <div class="card border-0 item-shadow overflow-hidden m-2 m-md-0 item-radius">
                            <div class="item-main">
                                <div class="favorite-category" :class="{'favorite-main-off':(!storage.favorite.includes(organization.id)),'favorite-main-on':(storage.favorite.includes(organization.id))}" @click="favorite(organization.id)"></div>
                                <div class="item-rating" v-if="organization.rating">
                                    <span>{{organization.rating}}</span>
                                </div>
                                <img v-if="organization.wallpaper" :src="organization.wallpaper">
                                <img v-else src="/img/logo/wall.png">
                            </div>
                            <div class="item-logo mb-md-2 d-flex justify-content-center">
                                <div class="item-logo-default">
                                    <img v-if="organization.image" :src="organization.image">
                                    <div style="background-image: url('/img/logo/restaurant.svg')"></div>
                                </div>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item text-center p-0">
                                    <a :href="'/home/'+organization.id" class="text-dark">
                                        <h3 class=" font-weight-bold item-title">{{organization.title}}</h3>
                                    </a>
                                    <p class="item-description text-secondary mx-3 my-0" v-if="organization.description">{{organization.description}}</p>
                                </li>
                                <li class="list-group-item text-center bg-light">
                                    <div class="h6 text-secondary text-font" v-if="organization.timeTitle">{{organization.timeTitle}}</div>
                                    <div class="text-center mb-0 mt-2 h6 text-secondary text-font">{{organization.address}}</div>
                                </li>
                                <li class="list-group-item">
                                    <a :href="'/home/'+organization.id" class="btn w-100 text-white text-btn text-font font-weight-bold d-flex justify-content-center align-content-center">
                                        <div class="py-md-1">Подробнее</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <not-found :params="notFound"></not-found>
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
import NotFound from './layout/Not-found'
export default {
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        NotFound
    },
    name: "Favorite",
    data() {
        return {
            list: [],
            notFound: {
                img: '/img/logo/favorite-red.svg',
                title: 'Список пуст',
                description: 'Здесь будет отображаться список добавленных вами заведении.'
            }
        }
    },
    created() {
        this.getOrganizations();
    },
    methods: {
        favorite: function(id) {
            let len =   this.storage.favorite.length;
            let status  =   true;
            for (let i = 0; i < len; i++) {
                if (this.storage.favorite[i] === id) {
                    this.storage.favorite.splice(i,1);
                    status  =   false;
                    this.getOrganizations();
                }
            }
            if (status) {
                this.storage.favorite.push(id);
            }
        },
        getOrganizations: function() {
            if (this.storage.favorite.length > 0) {
                axios.post('/api/organization/ids',{
                    ids: this.storage.favorite
                })
                    .then(response => {
                        let data    =   response.data.data;
                        for (let i = 0; i < data.length; i++) {
                            data[i].timeTitle   =   this.getTime(data[i]);
                            this.list.push(data[i]);
                        }
                    });
            } else {
                this.storage.favorite   =   [];
                this.list   =   [];
            }
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
