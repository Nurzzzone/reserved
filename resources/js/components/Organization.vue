<template>
    <Header></Header>
    <profile-section :name="name" :id="$route.params.id"></profile-section>
    <template v-if="!loading">
        <template v-if="organization">
            <Booking :organization="organization" :table="table" :date="date"></Booking>
            <div class="container-fluid">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="wallpaper">
                                <div class="wallpaper-screen">
                                    <div class="organization-description text-center text-white">{{organization.address}}</div>
                                    <div class="organization-description text-center text-white">{{date.timeTitle}}</div>
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
                            <div class="organization-title text-dark font-weight-bold text-center">
                                <div>{{organization.title}}</div>
                                <div class="favorite-main" :class="{'favorite-main-off':(!storage.favorite.includes(organization.id)),'favorite-main-on':(storage.favorite.includes(organization.id))}" @click="favorite(organization.id)"></div>
                            </div>
                            <div class="organization-rating">
                                <div>
                                    <div class="organization-rating-star" :class="{'organization-rating-star-sel':(organization.rating >= 0.5)}"></div>
                                    <div class="organization-rating-star" :class="{'organization-rating-star-sel':(organization.rating >= 1.5)}"></div>
                                    <div class="organization-rating-star" :class="{'organization-rating-star-sel':(organization.rating >= 2.5)}"></div>
                                    <div class="organization-rating-star" :class="{'organization-rating-star-sel':(organization.rating >= 3.5)}"></div>
                                    <div class="organization-rating-star" :class="{'organization-rating-star-sel':(organization.rating >= 4.5)}"></div>
                                    <div class="organization-rating-count" v-if="organization.rating">{{organization.rating}}</div>
                                </div>
                            </div>
                            <div class="organization-description text-secondary text-center">{{organization.description}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid organization-shadow-main">
                <div class="container">
                    <div class="row pt-2">
                        <div class="col d-flex justify-content-center">
                            <div class="card text-center bg-transparent border-0">
                                <div class="card-header bg-transparent d-flex justify-content-center border-0">
                                    <ul class="nav nav-tabs card-header-tabs margin-0 border-0">
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 px-0 d-block" :class="{active: (tab === 1), 'organization-tab-sel': (tab === 1)}" role="button" @click="tab = 1">Бронирование</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 px-0 d-block" :class="{active: (tab === 2), 'organization-tab-sel': (tab === 2)}" role="button" @click="tab = 2">Галлерея</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link h6 text-secondary bg-transparent organization-tab py-3 px-0 d-block" :class="{active: (tab === 3), 'organization-tab-sel': (tab === 3)}" role="button" @click="tab = 3">Отзывы</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pb-3 pb-md-5 organization-bg">
                <div class="container">
                    <div class="row pt-4">
                        <div class="col-12">
                            <div v-if="tab === 1">
                                <div class="row justify-content-center mt-md-3">
                                    <div class="col-12 col-md-6 col-lg-4 p-0">
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
                                            <button type="button" class="btn organization-btn font-weight-bold mx-2" v-for="(item,key) in sections" :key="key" :class="{'organization-btn-sel':(key === section)}" @click="section = key">{{item.name}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-4"  v-for="(item,key) in sections" :key="key" :class="{'d-none':(key !== section)}">
                                    <div class="col-6 col-lg-3 p-md-2 p-1" v-for="(table,tableKey) in item.organization_tables" :key="tableKey" @click="selTable(key,tableKey)">
                                        <div class="card border-0 organization-shadow" data-toggle="modal" data-target="#booking_modal">
                                            <div class="card-body organization-card-main">
                                                <div class="organization-card">
                                                    <div class="row align-content-center pl-3">
                                                        <div class="organization-card-title w-100 font-weight-bold">{{table.title}}</div>
                                                        <template v-if="table.bookingStatus === undefined">
                                                            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                                                        </template>
                                                        <template v-else-if="table.status === 'ENABLED' && (table.bookingStatus === null || table.bookingStatus.status === 'COMPLETED')">
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
                                <template v-if="organization && organization.images">
                                    <template v-if="organization.images.length > 0">
                                        <div class="row justify-content-center" v-if="organization.images.length > 0">
                                            <div class="col-3 p-2" v-for="(image,imageKey) in organization.images" :key="imageKey">
                                                <div class="organization-image" :style="{'background-image':'url('+image.image+')'}" @click="showImg(imageKey)">
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="container-fluid">
                                            <div class="container pt-md-5">
                                                <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                                                    <div>
                                                        <img src="/img/logo/no-photo.svg" width="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 mb-5">
                                                    <h2 class="text-center organization-empty-title font-weight-bold">Пусто</h2>
                                                    <p class="text-center organization-empty-description text-secondary">Фотографии не найдено</p>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </div>
                            <div v-if="tab === 3">
                                <template v-if="reviewStatus">
                                    <div class="row py-5">
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="loading">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <h4 class="loading-text">Загружаем данные</h4>
                                        </div>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-if="reviews.length > 0">
                                        <div>
                                            <div class="row p-0 py-md-2">
                                                <div class="col-12 p-0 d-flex justify-content-center">
                                                    <div class=" organization-comment-count text-secondary" v-if="reviewCount === 1">{{reviewCount}} отзыв</div>
                                                    <div class=" organization-comment-count text-secondary" v-else>{{reviewCount}} отзыва</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row py-0 py-md-4 p-0 organization-comment-line" v-for="(review,key) in reviews" :key="key">
                                                <div class="col-12 col-sm-6 col-md-3 p-0">
                                                    <div class="organization-comment">
                                                        <div class="organization-comment-icon">
                                                            <div>{{review.user.name[0]}}</div>
                                                        </div>
                                                        <div class="organization-comment-detail">
                                                            <div class="organization-comment-detail-name">
                                                                <span class="organization-comment-detail-name-user">{{review.user.name}}</span>
                                                                <span class="organization-comment-detail-dot text-secondary font-weight-normal">•</span>
                                                                <span class="text-secondary font-weight-normal">{{review.created_at}}</span>
                                                            </div>
                                                            <div class="organization-comment-detail-stars">
                                                                <div class="organization-comment-detail-star" :class="{'organization-comment-detail-star-sel':(review.rating >= 1)}"></div>
                                                                <div class="organization-comment-detail-star" :class="{'organization-comment-detail-star-sel':(review.rating >= 2)}"></div>
                                                                <div class="organization-comment-detail-star" :class="{'organization-comment-detail-star-sel':(review.rating >= 3)}"></div>
                                                                <div class="organization-comment-detail-star" :class="{'organization-comment-detail-star-sel':(review.rating >= 4)}"></div>
                                                                <div class="organization-comment-detail-star" :class="{'organization-comment-detail-star-sel':(review.rating >= 5)}"></div>
                                                            </div>
                                                            <div class="organization-comment-detail-status" v-if="review.status === 'CHECKING'">
                                                                <div>На проверке</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-9 p-0 d-flex align-items-center">
                                                    <div class="organization-comment-text">{{review.comment.replace(/\n/g, '<br />')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="container-fluid">
                                            <div class="container pt-md-5">
                                                <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                                                    <div>
                                                        <img src="/img/logo/chat.svg" width="100">
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 mb-5">
                                                    <h2 class="text-center organization-empty-title font-weight-bold">Пусто</h2>
                                                    <p class="text-center organization-empty-description text-secondary">Еще никто не оставлял комментарий</p>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="container-fluid">
                <div class="container pt-md-5">
                    <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                        <div>
                            <img src="/img/logo/table.svg" width="100">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-5">
                        <h2 class="text-center organization-empty-title font-weight-bold">Заведение не найдено</h2>
                        <p class="text-center organization-empty-description text-secondary">Возможно в данный момент заведение закрыт</p>
                    </div>
                </div>
            </div>
        </template>
        <vue-easy-lightbox
            scrollDisabled
            escDisabled
            moveDisabled
            :visible="img.visible"
            :imgs="img.list"
            :index="img.index"
            @hide="handleHide"
        >
            <template v-slot:toolbar="{ toolbarMethods }">

            </template>
        </vue-easy-lightbox>
    </template>
    <template v-else>
        <div class="container-fluid">
            <div class="container">
                <div class="row my-5 py-5">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="loading">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <h4 class="loading-text">Загружаем данные</h4>
                    </div>
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
import VueEasyLightbox from 'vue-easy-lightbox';
export default {
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        Booking,
        VueEasyLightbox
    },
    name: "Organization",
    data() {
        return {
            toolbarMethods: {},
            img: {
                visible: false,
                index: 0,
                list: [],
            },
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
                timeTitle: '',
                before: false,
                after: true,
                title: '',
                data: '',
                timeIndex: 0,
                time: [],
                timeList: [
                    {
                        time: '00:00',
                    },
                    {
                        time: '01:00',
                    },
                    {
                        time: '02:00',
                    },
                    {
                        time: '03:00',
                    },
                    {
                        time: '03:00',
                    },
                    {
                        time: '04:00',
                    },
                    {
                        time: '05:00',
                    },
                    {
                        time: '06:00',
                    },
                    {
                        time: '07:00',
                    },
                    {
                        time: '08:00',
                    },
                    {
                        time: '09:00',
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
                },
            },
            reviewCount: 0,
            reviewStatus: true,
            reviewLoading: true,
            reviews: []
        }
    },
    watch: {
        tab: function() {
            if (this.tab === 3) {
                this.getReviews();
            }
        }
    },
    created() {
        this.setDateTime();
        this.getOrganization();
    },
    methods: {
        showImg: function(index) {
            this.img.index = index
            this.img.visible = true
        },
        handleHide: function() {
            this.img.visible = false
        },
        getReviewCount: function() {
            axios.get('/api/review/count/organization/'+this.organization.id)
                .then(response => {
                    this.reviewCount    =   response.data;
                });
        },
        getReviews: function() {
            if (this.reviewLoading) {
                this.getReviewCount();
                this.reviewLoading   =   false;
                axios.get('/api/review/list/organization/'+this.organization.id)
                .then(response => {
                    this.reviewStatus   =   false;
                    let data    =   response.data;
                    if (data.hasOwnProperty('data')) {
                        this.reviews    =   data.data;
                    }
                }).catch(error => {
                    this.reviewStatus   =   false;
                });
            }
        },
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
        updateStatus: async function() {
            let self    =   this;
            return axios.get('/api/organization/status/'+this.$route.params.id+'/'+this.date.data)
                .then(response => {
                    let data    =   response.data;
                    let statuses    =   [];
                    data.forEach(element => {
                        if (!statuses[element.organization_table_id]) {
                            statuses[element.organization_table_id]    =   [];
                        }
                        statuses[element.organization_table_id].push(element);
                    });
                    this.sections.forEach(element => {
                        if (statuses[element.id]) {
                            element.organization_tables =   statuses[element.id];
                        }
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
                    this.setTime();
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
            this.setTime();
        },
        setDateTime: function() {
            let date    =   new Date();
            let year    =   date.getFullYear();
            let month   =   date.getMonth();
            let day     =   date.getDate();
            this.date.title =   day+' '+this.date.monthName[this.lang][month];
            this.date.data  =   year+'-'+(month + 1)+'-'+day;
        },
        setTime: function() {
            let date    =   this.date.data.split('-');
            date        =   new Date(date[0],(date[1]-1),date[2]);
            let weekDay =   date.getDay();
            let week;
            if (weekDay === 0) {
                week    =   this.organization.sunday;
            } else if (weekDay === 1) {
                week    =   this.organization.monday;
            } else if (weekDay === 2) {
                week    =   this.organization.tuesday;
            } else if (weekDay === 3) {
                week    =   this.organization.wednesday;
            } else if (weekDay === 4) {
                week    =   this.organization.thursday;
            } else if (weekDay === 5) {
                week    =   this.organization.friday;
            } else if (weekDay === 6) {
                week    =   this.organization.saturday;
            }
            let today   =   new Date();

            if (week.start === week.end) {
                this.date.timeTitle =   'круглосуточно';
            } else {
                this.date.timeTitle  =   this.timeConvert(week.start)+' '+this.timeConvert(week.end);
            }
            let timeToday   =   new Date(today.getFullYear(),today.getMonth(),today.getDate());
            let item;
            let start   =   week.start.split(':');
            this.date.timeIndex =   0;
            this.date.time  =   [];
            if (timeToday.getTime() === date.getTime()) {
                this.date.timeList.forEach(element => {
                    item    =   element.time.split(':');
                    if (parseInt(today.getHours()) < parseInt(item[0]) && parseInt(today.getHours()) > parseInt(start[0])) {
                        this.date.time.push(element);
                    }
                });
            } else {
                this.date.time  =   this.date.timeList;
            }
        },
        timeConvert: function(time) {
            let converted   =   time.split(':');
            return converted[0]+'.'+converted[1];
        },
        selTable: async function (key, tableKey) {
            await this.updateStatus();
            this.storage.modal = false;
            this.table = this.sections[key].organization_tables[tableKey];
            this.setTime();
        },
        getOrganization: function() {
            axios.get('/api/organization/'+this.$route.params.id)
                .then(response => {
                    let data    =   response.data;
                    if (data.hasOwnProperty('data')) {
                        this.organization   =   data.data;
                        this.organization.images.forEach(element => {
                            this.img.list.push(element.image);
                        });
                        this.setTime();
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
    @import '../../css/favorite/favorite.scss';
    @import '../../css/organization/organization.scss';
</style>
