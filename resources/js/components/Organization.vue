<template>
    <Header></Header>
    <profile-section :name="name"></profile-section>
    <template v-if="!loading">
        <template v-if="organization">
            <Booking :organization="organization" :table="table" :date="date"></Booking>
            <div class="container-fluid organization-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="wallpaper">
                                <div class="wallpaper-screen">
                                    <div class="organization-description text-center text-white">{{organization.address}}</div>
                                    <div class="organization-description text-center text-white">{{organization.time}}</div>
                                </div>
                                <img v-if="organization.wallpaper" :src="organization.wallpaper">
                                <img v-else src="/img/logo/wall.png">
                            </div>
                            <div class="d-flex justify-content-center organization-photo">
                                <div class="organization-logo">
                                    <img v-if="organization.image" :src="organization.image">
                                    <div v-else-if="organization.category_id.id === 1" class="organization-logo-default organization-logo-default-restaurant"></div>
                                    <div v-else-if="organization.category_id.id === 2" class="organization-logo-default organization-logo-default-cafe"></div>
                                    <div v-else-if="organization.category_id.id === 3" class="organization-logo-default organization-logo-default-bar"></div>
                                </div>
                            </div>
                            <div class="organization-title h3 text-dark font-weight-bold text-center mt-3">{{organization.title}}</div>
                            <div class="organization-description h6 text-secondary text-center mt-3">{{organization.description}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid organization-shadow-main organization-bg">
                <div class="container">
                    <div class="row pt-2">
                        <div class="col d-flex justify-content-center">
                            <div class="card text-center bg-transparent border-0">
                                <div class="card-header bg-transparent d-flex justify-content-center border-0">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 d-block" :class="{active: (tab === 1), 'organization-tab-sel': (tab === 1)}" role="button" @click="tab = 1">Бронирование</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 d-block" :class="{active: (tab === 2), 'organization-tab-sel': (tab === 2)}" role="button" @click="tab = 2">Галлерея</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 d-block" :class="{active: (tab === 3), 'organization-tab-sel': (tab === 3)}" role="button" @click="tab = 3">Отзывы</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mb-5">
                <div class="container">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div v-if="tab === 1">
                                <div class="row justify-content-center mt-3">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="form-group organization-date" onselectstart="return false;">
                                            <a class="text-decoration-none cursor-pointer" :class="{'organization-arr-btn':date.before}" @click="previousDay()">&#8249;</a>
                                            <div type="text" class="border-0 organization-input text-dark text-center font-weight-bold" :data-date="date.data">
                                                <div>{{date.title}}</div>
                                            </div>
                                            <a class="text-decoration-none cursor-pointer" :class="{'organization-arr-btn':date.after}" @click="nextDay()">&#8250;</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3">
                                    <div>
                                        <div class="d-flex">
                                            <button type="button" class="btn organization-btn font-weight-bold mx-2 px-5" v-for="(item,key) in sections" :key="key" :class="{'organization-btn-sel':(key === section)}" @click="section = key">{{item.name}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4"  v-for="(item,key) in sections" :key="key" :class="{'d-none':(key !== section)}">
                                    <div class="col-12 col-md-6 col-lg-3 p-2" v-for="(table,tableKey) in item.organization_tables" :key="tableKey" @click="selTable(key,tableKey)">
                                        <div class="card border-0 organization-shadow" data-toggle="modal" data-target="#booking_modal">
                                            <div class="card-body">
                                                <div class="organization-card">
                                                    <div class="row align-content-center pl-3">
                                                        <div class="organization-card-title w-100 font-weight-bold">{{table.title}}</div>
                                                        <template v-if="!table.bookingStatus">
                                                            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                                        </template>
                                                        <template v-else-if="table.bookingStatus === 'free'">
                                                            <div class="organization-card-status organization-card-status-free">Свободно</div>
                                                        </template>
                                                        <template v-else>
                                                            <div class="organization-card-status organization-card-status-reserved">Занято</div>
                                                        </template>
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
        </template>
        <template v-else>
            <div class="container-fluid">
                <div class="container py-5">
                    <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                        <div>
                            <img src="/img/logo/table.svg" width="120">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-5">
                        <h2 class="text-center">Заведение не найдено</h2>
                        <p class="text-center h5 text-secondary mt-2">Возможно в данный момент заведение закрыт.</p>
                    </div>
                </div>
            </div>
        </template>
    </template>
    <template v-else>
        <div class="container-fluid py-5 my-5">
            <div class="container py-5 my-5">
                <div class="col-12 d-flex justify-content-center">
                    <div class="lds-dual-ring"></div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <h6 class="font-weight-bold text-secondary">Подождите немного...</h6>
                </div>
            </div>
        </div>
    </template>
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
            loading: true,
            lang: 'ru',
            status: 0,
            name: '',
            tab: 1,
            table: '',
            organization: false,
            section: 0,
            sections: [],
            date: {
                before: false,
                after: true,
                title: '',
                data: '',
                timeIndex: 0,
                time: [
                    {
                        time: '10:00',
                    },
                    {
                        time: '11:00',
                    },
                    {
                        time: '12:00',
                    },
                    {
                        time: '13:00',
                    },
                    {
                        time: '14:00',
                    },
                    {
                        time: '15:00',
                    },
                    {
                        time: '16:00',
                    },
                    {
                        time: '17:00',
                    },
                    {
                        time: '18:00',
                    },
                    {
                        time: '19:00',
                    },
                    {
                        time: '20:00',
                    },
                    {
                        time: '21:00',
                    },
                    {
                        time: '22:00',
                    },
                    {
                        time: '23:00',
                    }
                ],
                monthName: {
                    ru: ['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря'],
                    en: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']
                }
            },
        }
    },
    created() {
        this.setDateTime();
        this.getOrganization();
    },
    methods: {
        updateStatus: function() {
            let self    =   this;
            axios.get('/api/organization/status/'+this.$route.params.id+'/'+this.date.data)
                .then(response => {
                    let data    =   response.data;
                    let statuses    =   [];
                    data.forEach(element => {
                        statuses[element.id]    =   element.bookingStatus.status;
                    });
                    this.sections.forEach(element => {
                        element.organization_tables.forEach(item => {
                            if (statuses[item.id]) {
                                item.bookingStatus  =   statuses[item.id];
                            }
                        });
                    });
                }).catch(error => {
                    setTimeout(function() {
                        self.updateStatus();
                    },1000);
                });
        },
        previousDay: function() {
            if (this.date.before) {
                let today   =   new Date();
                today       =   new Date(today.getFullYear(),today.getMonth(),today.getDate());
                let date    =   this.date.data.split('-');
                let current =   new Date(date[0],(date[1] - 1),date[2]);
                current.setDate(current.getDate() - 1);
                if (today.getTime() <= current.getTime()) {
                    let year    =   current.getFullYear();
                    let month   =   current.getMonth();
                    let day     =   current.getDate();
                    this.date.title =   day+' '+this.date.monthName[this.lang][month];
                    this.date.data  =   year+'-'+(month + 1)+'-'+day;
                    if (today.getTime() === current.getTime()) {
                        this.date.before    =   false;
                    }
                    this.updateStatus();
                }
            }
        },
        nextDay: function() {
            let date    =   this.date.data.split('-');
            let current =   new Date(date[0],(date[1]-1),date[2]);
            current.setDate(current.getDate() + 1);
            let year    =   current.getFullYear();
            let month   =   current.getMonth();
            let day     =   current.getDate();
            this.date.title =   day+' '+this.date.monthName[this.lang][month];
            this.date.data  =   year+'-'+(month + 1)+'-'+day;
            this.date.before    =   true;
            this.updateStatus();
        },
        setDateTime: function() {
            let date    =   new Date();
            let year    =   date.getFullYear();
            let month   =   date.getMonth();
            let day     =   date.getDate();
            this.date.title =   day+' '+this.date.monthName[this.lang][month];
            this.date.data  =   year+'-'+(month + 1)+'-'+day;
        },
        selTable: function(key, tableKey) {
            this.updateStatus();
            this.storage.modal = false;
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
                    this.loading    =   false;
                }).catch(error => {
                    this.loading    =   false;
                });
        },
        getSections: function(id) {
            axios.get('/api/organization/section/'+id)
                .then(response => {
                    let data    =   response.data;
                    if (data.hasOwnProperty('data')) {
                        this.sections   =   data.data;
                        this.updateStatus();
                    }
                });
        }
    }
}
</script>

<style lang="scss">
    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #00a082;
        border-color: #00a082 transparent #00a082 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    .lds-ellipsis {
        display: inline-block;
        position: relative;
        width: 20px;
        height: 20px;
        transform: scale(.5);
        margin: 5px 0 0 0;
    }
    .lds-ellipsis div {
        position: absolute;
        top: 0;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #00a082;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }
    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }
        100% {
            transform: scale(1);
        }
    }
    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
    }
    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }
        100% {
            transform: translate(24px, 0);
        }
    }
    .organization {
        &-tab {
            border:  none !important;
            border-bottom: 4px solid transparent !important;
            &-sel {
                color: #FF8008 !important;
                border-bottom-color: #FF8008 !important;
            }
        }
        &-bg {
            background: #f5f5f5;
        }
        &-arr {
            &-btn {
                background: #00a082;
                color: white;
                border-radius: 30px;
                cursor: pointer;
            }
        }
        &-date {
            display: grid;
            grid-template-columns: 40px auto 40px;
            grid-gap: 10px;
            padding: 5px;
            background: rgb(250,250,250);
            border-radius: 40px;
            margin: 0 .5rem 0 .5rem!important;
        }
        &-input {
            display: flex;
            justify-content: center;
            align-items: center;
            & > div {

            }
        }
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
                display: flex;
                padding: 2px 10px 2px 10px;
                border-radius: 3px;
                font-weight: bold;
                margin-top: 5px;
                &-free {
                    background: #00a082;
                    color: #fff;
                }
                &-reserved {
                    background: #FF8008;
                    color: #fff;
                }
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
            &-main {
                box-shadow: 0 3px 3px rgba(0,0,0,.1);
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

            &-default {
                width: 100%;
                height: 100%;
                background: no-repeat center;
                background-size: 50%;
                &-restaurant {
                    background-image: url('/img/logo/restaurant.svg');
                }
                &-cafe {
                    background-image: url('/img/logo/cafe.svg');
                }
                &-bar {
                    background-image: url('/img/logo/bar.svg');
                }
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
