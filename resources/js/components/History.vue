<template>
    <Header></Header>
    <profile-section></profile-section>
    <div class="container-fluid mb-5">
        <div class="container">
            <template v-if="bookings.length > 0">
                <div class="row mt-5">
                    <div class="col-12">
                        <h2 class=" top-title">История бронирования</h2>
                        <p class="mt-5 h6 text-secondary text-justify">
                            Здесь вы можете просматривать вашу историю бронировани в заведениях.
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center" v-for="(booking,key) in bookings" :key="key">
                                <div class="d-flex">
                                    <div class="payments-card-icon history-icon mr-3"></div>
                                    <div>
                                        <div class="history-font font-weight-bold"> • <span class="text-secondary">{{booking.organization_tables.title}}</span></div>
                                        <p class="history-font text-secondary m-0">{{booking.date}} • {{booking.time}}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="history-status history-status-waiting" v-if="booking.status === 'CHECKING'">
                                        Ожидает оплаты {{booking.price}} KZT
                                    </div>
                                    <div class="history-status history-status-success" v-else>
                                        Забронировано {{booking.price}} KZT
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
            bookings: [],
            user: false,
            paginate: 1
        }
    },
    created() {
        this.getUser();
        this.getBookings();
    },
    methods: {
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
                            this.bookings   =   data.data;
                            console.log(data.data);
                            setTimeout(function() {
                                self.getBookings();
                            },1000);
                        }
                    }).catch(error => {
                        setTimeout(function() {
                            self.getBookings();
                        },1000);
                    });
            }
        }
    }
}
</script>

<style lang="scss">
    .history {
        &-font {
            font-size: 15px;
        }
        &-shadow {
            box-shadow: 0 0 5px 0 rgba(0,0,0,.1);
            border-radius: 10px;
            overflow: hidden;
        }
        &-icon {
            width: 44px;
            height: 44px;
            background: url(/img/logo/calendar.svg) no-repeat center;
            background-size: contain;
        }
        &-status {
            padding: 8px 10px 8px 10px;
            color: white;
            font-weight: bold;
            border-radius: 30px;
            font-size: 13px;
            &-waiting {
                background: #FF8008;
            }
            &-success {
                background: #00a082;
            }
        }
    }
</style>
