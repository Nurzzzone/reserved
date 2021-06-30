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
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin at felis mattis, tincidunt diam eget, venenatis erat. Proin at urna at est sollicitudin volutpat sit amet ut orci. Nunc faucibus neque a purus viverra, vitae aliquam massa tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
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
                    <div class="container-fluid">
                        <div class="container pt-5">
                            <div class="col-12 d-flex justify-content-center mt-5 mb-3">
                                <div>
                                    <img src="/img/logo/card.svg" width="120">
                                </div>
                            </div>
                            <div class="col-12 mt-3 mb-5">
                                <h2 class="text-center">Список пуст</h2>
                                <p class="text-center h5 text-secondary mt-2">Вы можете добавить карту нажав кнопку ниже.</p>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="container-fluid">
                    <div class="container pb-5">
                        <div class="col-12 d-flex justify-content-center align-content-center">
                            <button class="btn text-white payments-btn" @click="newCard">
                                <span v-if="cardStatus">Добавить карту</span>
                                <div class="spinner" v-else></div>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else>
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
                        <h4 class="text-secondary text-center">Загружаем данные</h4>
                    </div>
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
import ProfileSection from "./sections/ProfileSection";
import FooterMenu from "./footerMenu/FooterMenu";
import CardModal from '././modal/Card';
export default {
    name: "Payments",
    components: {
        Header,
        Footer,
        ProfileSection,
        FooterMenu,
        CardModal
    },
    data() {
        return {
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
                        },1500);
                    }).catch(error => {
                        this.updateStatus   =   true;
                        setTimeout(function() {
                            self.cardUpdate();
                        },1500);
                        console.log(error.response);
                    });
            }
        },
        newCard: function() {
            if (this.cardStatus) {
                this.cardStatus =   false;
                axios.get('/api/payment/card/'+this.user.id)
                    .then(response => {
                        this.cardStatus =   true;
                        window.open(response.data,'_blank');
                        this.cardUpdate();
                    }).catch(error => {
                        this.cardStatus =   true;
                        console.error(error.response.data);
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
                        console.log(error.response);
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
    .loading {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .loading div {
        position: absolute;
        top: 33px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #00a082;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }
    .loading div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }
    .loading div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .loading div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }
    .loading div:nth-child(4) {
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

</style>
