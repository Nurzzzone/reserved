<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-md-5">
        <div class="container p-0">
            <template v-if="items.length > 0">
                <div class="row">
                    <div class="col-12">
                        <h2 class="history-title">История бронирования</h2>
                        <p class="history-description">
                            Здесь вы можете просматривать вашу историю бронировани в заведениях.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center" v-for="(item,key) in items" :key="key">
                                <div class="d-flex" v-if="item">
                                    <div class="history-card-icon history-icon mr-md-3"></div>
                                    <div>
                                        <div class="history-font font-weight-bold">
                                            <a :href="'/home/'+item.organization.id" class="p-0 text-dark">{{item.organization.title}}</a> • <span class="text-secondary" v-if="item.organization_tables.title">{{item.organization_tables.title}}</span>
                                        </div>
                                        <p class="history-font text-secondary m-0">{{item.date}} • {{item.time}}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="history-status history-status-waiting" v-if="item.status === 'CHECKING'" @click="initPayment(key)">
                                        Ожидает оплаты {{item.price}} KZT
                                    </div>
                                    <div class="history-status history-status-success" v-else>
                                        Забронировано {{item.price}} KZT
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </template>
            <template v-else>
                <div class="col-12 d-flex justify-content-center my-5 pt-5">
                    <div>
                        <img src="/img/logo/calendar.svg" width="120">
                    </div>
                </div>
                <div class="col-12 mt-3 mb-5 pb-5">
                    <h2 class="text-center">Пусто</h2>
                    <p class="text-center h5 text-secondary mt-2">Ваша история заказов будет отображаться здесь.</p>
                </div>
            </template>
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
    name: "History",
    data() {
        return {
            items: [],
            user: false,
            paginate: 1
        }
    },
    created() {
        this.getUser();
    },
    mounted() {
        this.getBookings();
    },
    methods: {
        initPayment: function(key) {
            let payment =   this.items[key];
            if (!payment.payment_id) {
                window.open(payment.payment,'_blank');
            } else {
                window.open('/form/'+payment.id,'_blank');
            }
        },
        getUser: function() {
            if (this.storage.token && sessionStorage.user) {
                this.user   =   JSON.parse(sessionStorage.user);
            } else {
                window.location.href = '/home';
            }
        },
        getBookings: function() {
            if (this.user) {
                let self    =   this;
                axios.get('/api/booking/user/'+this.user.id+'?paginate='+this.paginate)
                    .then(response => {
                        let data    =   response.data;
                        if (data.hasOwnProperty('data')) {
                            this.items  =   data.data;
                            setTimeout(function() {
                                self.getBookings();
                            },1500);
                        }
                    }).catch(error => {
                        setTimeout(function() {
                            self.getBookings();
                        },1500);
                    });
            }
        }
    }
}
</script>

<style lang="scss">
    @import '../../css/profile/history.scss';
</style>
