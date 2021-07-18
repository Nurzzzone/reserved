<template>
    <Header></Header>
    <profile-section></profile-section>
    <card-modal :modal="cardModal" :card="card" :index="key" @delete="deleteCardReady"></card-modal>
    <div class="container-fluid mb-md-5">
        <div class="container p-0">
            <template v-if="!cardLoading">
                <template v-if="cards.length > 0">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="payments-title">Ваши карточки</h2>
                            <p class="payments-description text-secondary text-justify">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat.
                            </p>
                        </div>
                    </div>
                    <div class="row payments-all">
                        <div class="col-12 p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 d-flex justify-content-between settings-item align-items-center" v-for="(card,key) in cards" :key="key">
                                    <div class="d-flex">
                                        <div class="payments-card-icon payments-card-icon-visa mr-3"></div>
                                        <div>
                                            <div class="payments-card-bank">{{card.bank}}</div>
                                            <p class="payments-card-hash text-secondary">{{card.hash}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="btn-group payments-list">
                                            <!--                                    <button class="payments-icon payments-icon-edit" @click="editCard(key)" data-toggle="modal" data-target="#card_modal"></button>-->
                                            <button class="payments-icon payments-icon-delete" @click="deleteCard(key)" data-toggle="modal" data-target="#card_modal"></button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <not-found :params="notFound"></not-found>
                </template>
                <div class="container-fluid">
                    <div class="container pb-5">
                        <div class="col-12 d-flex justify-content-center align-content-center">
                            <button class="btn text-white payments-btn" @click="newCard">
                                <span v-if="cardStatus">Добавить карту</span>
                                <div class="loading-btn" v-else>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
                <loading></loading>
            </template>
        </div>
    </div>
    <Footer-menu></Footer-menu>
    <Footer></Footer>
</template>

<script>
import Header from "./header/Header";
import Footer from "./footer/Footer";
import ProfileSection from "./sections/ProfileSection";
import FooterMenu from "./footerMenu/FooterMenu";
import CardModal from '././modal/Card';
import NotFound from './layout/Not-found';
import Loading from './layout/Loading';
export default {
    name: "Payments",
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        CardModal,
        NotFound,
        Loading
    },
    data() {
        return {
            notFound: {
                img: '/img/logo/card.svg',
                title: 'Список пуст',
                description: 'Вы можете добавить карту'
            },
            cardStatus: true,
            cardLoading: true,
            cardModal: true,
            cards: [],
            user: false,
            card: {},
            key: 0,
            updateStatus: true
        }
    },
    created() {
        this.getUser();
        this.getCards();
    },
    methods: {
        cardUpdate: function() {
            if (this.updateStatus) {
                this.updateStatus   =   false;
                let self    =   this;
                axios.get('/api/card/user/'+this.user.id)
                    .then(response => {
                        this.cards  =   response.data;
                        this.updateStatus   =   true;
                        setTimeout(function() {
                            self.cardUpdate();
                        },2000);
                    }).catch(error => {
                        this.updateStatus   =   true;
                        setTimeout(function() {
                            self.cardUpdate();
                        },2000);
                        console.log(error.response);
                    });
            }
        },
        newCard: function() {
            if (this.cardStatus) {
                this.cardStatus =   false;
                let wind    =   window.open();
                axios.get('/api/payment/card/'+this.user.id)
                    .then(response => {
                        this.cardStatus =   true;
                        wind.location = response.data;
                        this.cardUpdate();
                    }).catch(error => {
                        this.cardStatus =   true;
                    });
            }
        },
        editCard: function(key) {
            this.cardModal  =   true;
            this.card       =   this.cards[key];
            this.key        =   key;
        },
        deleteCardReady: function(key) {
            this.cards.splice(key,1);
        },
        deleteCard: function(key) {
            this.cardModal  =   false;
            this.card       =   this.cards[key];
            this.key        =   key;
        },
        getCards: function() {
            if (this.user) {
                axios.get('/api/card/user/'+this.user.id)
                    .then(response => {
                        this.cards  =   response.data;
                        this.cardLoading    =   false;
                    }).catch(error => {
                        this.cardLoading    =   false;
                    });
            }
        },
        getUser: function() {
            if (this.storage.token && sessionStorage.user) {
                this.user   =   JSON.parse(sessionStorage.user);
            } else {
                window.location.href = '/home';
            }
        },
    }
}
</script>

<style lang="scss">
    @import '../../css/payments/payments.scss';
</style>
