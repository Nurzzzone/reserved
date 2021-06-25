<template>
    <Header></Header>
    <profile-section :name="name"></profile-section>
    <Booking :organization="organization" :table="table"></Booking>
    <div class="container-fluid mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wallpaper">
                        <div class="wallpaper-screen">
                            <div class="organization-description text-center text-white">{{organization.address}}</div>
                            <div class="organization-description text-center text-white">{{organization.time}}</div>
                        </div>
                        <img :src="organization.wallpaper">
                    </div>
                    <div class="d-flex justify-content-center organization-photo">
                        <div class="organization-logo">
                            <img :src="organization.image">
                        </div>
                    </div>
                    <div class="organization-title h3 text-dark font-weight-bold text-center mt-3">{{organization.title}}</div>
                    <div class="organization-description h6 text-secondary text-center mt-3">{{organization.description}}</div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col d-flex justify-content-center">
                    <div class="card text-center border-0">
                        <div class="card-header bg-transparent d-flex justify-content-center">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link h6 text-secondary" :class="{active: (tab === 1), 'main-color': (tab === 1)}" role="button" @click="tab = 1">Бронирование</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link h6 text-secondary" :class="{active: (tab === 2), 'main-color': (tab === 2)}" role="button" @click="tab = 2">Галлерея</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link h6 text-secondary" :class="{active: (tab === 3), 'main-color': (tab === 3)}" role="button" @click="tab = 3">Отзывы</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div v-if="tab === 1">
                        <div class="row justify-content-center mt-3">
                            <div>
                                <div class="d-flex">
                                    <button type="button" class="btn organization-btn font-weight-bold mx-2 px-5" v-for="(item,key) in sections" :key="key" :class="{'organization-btn-sel':(key === section)}" @click="section = key">{{item.name}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4"  v-for="(item,key) in sections" :key="key" :class="{'d-none':(key !== section)}">
                            <div class="col-12 col-md-6 col-lg-3 p-2" v-for="(table,tableKey) in item.organization_tables" :key="tableKey" @click="selTable(key,tableKey)">
                                <div class="card border-0 organization-shadow"  data-toggle="modal" data-target="#booking_modal">
                                    <div class="card-body">
                                        <div class="organization-card">
                                            <div class="row align-content-center pl-3">
                                                <div class="organization-card-title w-100 font-weight-bold">{{table.title}}</div>
                                                <div class="organization-card-status w-100 text-secondary">Свободно</div>
                                            </div>
                                            <div>
                                                <div class="organization-card-icon"></div>
                                                <div class="organization-card-limit text-secondary text-center">{{table.limit}} чл.</div>
                                            </div>
                                            <div class="organization-card-arr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="tab === 2">
                        <div class="row justify-content-center">
                            <div class="col-3 p-2" v-for="(image,imageKey) in organization.images" :key="imageKey">
                                <div class="organization-image" :style="{'background-image':'url('+image.image+')'}">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="tab === 3">

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
import Booking from './modal/Booking';
export default {
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        Booking
    },
    name: "Organization",
    data() {
        return {
            status: 0,
            name: '',
            tab: 1,
            table: '',
            organization: {},
            section: 0,
            sections: []
        }
    },
    created() {
        this.getOrganization();
    },
    methods: {
        selTable: function(key, tableKey) {
            this.table  =   this.sections[key].organization_tables[tableKey];
        },
        getOrganization: function() {
            axios.get('/api/organization/'+this.$route.params.id)
                .then(response => {
                    let data    =   response.data;
                    if (data.hasOwnProperty('data')) {
                        this.organization   =   data.data;
                        this.name   =   this.organization.title;
                        this.getSections(this.organization.id);
                    }
                });
        },
        getSections: function(id) {
            axios.get('/api/organization/section/'+id)
                .then(response => {
                    let data    =   response.data;
                    if (data.hasOwnProperty('data')) {
                        this.sections   =   data.data;
                    }
                });
        }
    }
}
</script>

<style lang="scss">
    .organization {
        &-description {
            margin-top: 30px;
        }
        &-photo {

        }
        &-card {
            &-arr {
                background: url('/img/logo/right-arrow.svg') no-repeat center;
                background-size: contain;
            }
            display: grid;
            grid-template-columns: auto 40px 15px;
            grid-gap: 15px;
            &-limit {
                font-size: 12px;
            }
            &-title {
                font-size: 16px;
            }
            &-status {
                font-size: 14px;
            }
            &-icon {
                background: url('/img/logo/table.svg') no-repeat center;
                background-size: contain;
                height: 40px;
            }
        }
        &-btn {
            border-radius: 30px;
            height: 44px;
            color: #000;
            background: rgb(240,240,240);
            &-sel, &:hover {
                background: #FF8008;
                color: #fff;
            }
        }
        &-shadow {
            box-shadow: 0 0 5px 0 rgba(0,0,0,.15);
            border-radius: 10px;
            cursor: pointer;
            &:hover {
                background: rgb(250,250,250);
            }
        }
        &-image {
            width: 100%;
            border-radius: 10px;
            background: no-repeat center;
            background-size: cover;
            & > div {
                width: 100%;
                padding-bottom: 100%;
            }
        }
        &-logo {
            margin: -150px auto 0 auto;
            width: 200px;
            height: 200px;
            position: relative;
            overflow: hidden;
            z-index: 3;
            border-radius: 200px;
            box-shadow: 0 0 0 10px white;
            background: #fff;
            & > img {
                width: 100%;
            }
        }
    }
    .wallpaper {
        max-height: 350px;
        position: relative;
        overflow: hidden;
        border-radius: 0 0 20px 20px;
        & > img {
            width: 100%;
        }
        &-screen {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,.5);
            z-index: 2;
        }
    }
    @media only screen and (max-width: 768px) {
        .organization {
            &-description {
                margin-top: 10px;
            }
            &-logo {
                width: 100px;
                margin-top: -75px;
                height: 100px;
            }
        }
    }
</style>
