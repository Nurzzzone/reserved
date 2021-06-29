<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid">
        <div class="container">
            <div class="row home-main">
                <div class="col-12 col-md-6 d-flex justify-content-center p-0" v-for="(item,key) in menu" :key="key">
                    <a :href="item.url" class="d-block w-100 text-decoration-none p-2">
                        <div class="home-category">
                            <div class="home-category-shadow">
                                <div class="home-category-shadow-layer">
                                    <div class="home-category-icon">
                                        <div :style="{'background-image': 'url('+item.img+')'}"></div>
                                    </div>
                                    <div>
                                        <div class="home-category-title">
                                            {{item.title}}
                                        </div>
                                        <div class="home-category-description">
                                            {{item.description}}
                                        </div>
                                    </div>
                                    <div class="home-category-arrow">
                                        <div></div>
                                    </div>
                                </div>
                                <div class="home-category-shadow-img home-bg" :style="{'background-image':'url('+item.wall+')'}"></div>
                            </div>
                        </div>
                    </a>
<!--                    <a :href="item.url" style="text-decoration: none !important;">
                        <div class="card border-0">
                            <div class="d-flex justify-content-center">
                                <img class="" :src="item.img" width="100">
                            </div>
                            <h3 class="card-title text-center text-dark">{{item.title}}</h3>
                        </div>
                    </a>-->
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
    name: "Home",
    data() {
        return {
            menu: [
                {
                    title: 'Рестораны',
                    description: 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
                    img: '/img/logo/restaurant.svg',
                    wall: '/img/main/img-12.jpg',
                    url: '/home/restaurants'
                },
                {
                    title: 'Кафе',
                    description: 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
                    img: '/img/logo/cafe.svg',
                    wall: '/img/main/img-13.jpg',
                    url: '/home/cafe'
                },
                {
                    title: 'Бары',
                    description: 'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...',
                    img: '/img/logo/bar.svg',
                    wall: '/img/main/img-14.jpg',
                    url: '/home/bars'
                },
            ]
        }
    }
}
</script>

<style lang="scss">
    @import '../../css/home/home.scss';
</style>
