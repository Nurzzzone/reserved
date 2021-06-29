<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 col-md-4 d-flex justify-content-center" v-for="(item,key) in menu" :key="key">
                    <a :href="item.url" style="text-decoration: none !important;">
                        <div class="card border-0">
                            <div class="d-flex justify-content-center">
                                <img class="mt-5 mb-3" :src="item.img" width="100">
                            </div>
                            <h3 class="card-title text-center mb-5 text-dark">{{item.title}}</h3>
                        </div>
                    </a>
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
                    img: '/img/logo/restaurant.svg',
                    url: '/home/restaurants'
                },
                {
                    title: 'Кафе',
                    img: '/img/logo/cafe.svg',
                    url: '/home/cafe'
                },
                {
                    title: 'Бары',
                    img: '/img/logo/bar.svg',
                    url: '/home/bars'
                },
            ]
        }
    }
}
</script>

<style lang="scss">

</style>
