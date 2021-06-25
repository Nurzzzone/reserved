<template>
    <div class="modal fade" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="booking_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content auth-modal">
                <div class="modal-body">
                    <div class="form-group d-flex justify-content-end">
                        <button class="auth-btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-group">
                        <h3 class="auth-title text-center">Бронирование стола</h3>
                        <h6 class="text-secondary text-center mt-3">{{table.title}}</h6>
                    </div>
                    <template v-if="status">
                        <template v-if="!authUser.next">
                            <div class="col-12 mt-3">
                                <div class="form-group booking-date" onselectstart="return false;">
                                    <a class="text-decoration-none cursor-pointer" :class="{'booking-arr-btn':date.before}" @click="previousDay()">&#8249;</a>
                                    <input type="text" class="border-0 booking-input text-dark text-center font-weight-bold" v-model="date.title" :data-date="date.data" readonly>
                                    <a class="text-decoration-none cursor-pointer" :class="{'booking-arr-btn':date.after}" @click="nextDay()">&#8250;</a>
                                </div>
                            </div>
                            <div class="col-12 mt-3" onselectstart="return false">
                                <div class="form-group booking-time">
                                    <div class="booking-time-item" v-for="(time,key) in date.time" :class="{'booking-time-item-sel':(key === date.timeIndex)}" :key="key" @click="date.timeIndex = key">{{time.time}}</div>
                                </div>
                            </div>
                            <div class="col-12 mt-4 mb-2">
                                <button class="btn btn-block auth-register text-white" @click="authUser.next = true">Далее</button>
                            </div>
                        </template>
                        <template v-else>
                            <template v-if="cards.length > 0">
                                <div class="form-group mx-3 booking-card-list" v-if="cardError">
                                    <h5 class="text-danger text-center">Произошла ошибка, попробуите заново!</h5>
                                </div>
                                <div class="form-group mx-3 booking-card-list">
                                    <div class="booking-card" :class="{'booking-card-sel':(key === cardIndex)}" v-for="(item,key) in cards" :key="key" @click="cardIndex = key">
                                        <div class="booking-card-icon"></div>
                                        <div class="booking-card-detail">
                                            <div class="booking-card-detail-title">{{item.bank}}</div>
                                            <div class="booking-card-detail-num">{{item.hash}}</div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <div class="booking-empty mt-3">
                                    <div class="booking-empty-icon"></div>
                                    <div class="booking-empty-title">У вас нет карт</div>
                                </div>
                            </template>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block bg-light text-dark" @click="bookingAddCard()" style="border-radius: 30px; height: 44px;">Добавить карту карту</button>
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-block auth-register text-white" @click="bookingAuthFinish()" :disabled="cards.length === 0">Оплатить {{organization.price}} KZT</button>
                            </div>
                            <div class="col-12 mt-4 mb-2">
                                <button class="btn btn-block auth-register text-white" @click="authUser.next = false">Назад</button>
                            </div>
                        </template>
                    </template>
                    <template v-else>

                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Booking",
    props: ['organization','table'],
    data() {
        return {
            lang: 'ru',
            status: false,
            cardStatus: true,
            cardError: false,
            user: {},
            cardIndex: 0,
            cards: [],
            date: {
                before: false,
                after: true,
                title: '24 июня',
                data: '2021-06-24',
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
            authUser: {
                status: true,
                next: false,
                card: '',
            },
        }
    },
    created() {
        this.setDateTime();
        this.setUser();
    },
    methods: {
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
        },
        setDateTime: function() {
            let date    =   new Date();
            let year    =   date.getFullYear();
            let month   =   date.getMonth();
            let day     =   date.getDate();
            this.date.title =   day+' '+this.date.monthName[this.lang][month];
            this.date.data  =   year+'-'+(month + 1)+'-'+day;
        },
        bookingAddCard: function() {
            axios.get('/api/payment/card/'+this.user.id)
            .then(response => {
                window.open(response.data,'_blank');
                this.cardUpdate();
            }).catch(error => {
                console.log(error.response.data);
            });
        },
        cardUpdate: function() {
            axios.get('/api/card/user/'+this.user.id)
            .then(response => {
                this.cards  =   response.data;
                let self    =   this;
                setTimeout(function() {
                    self.cardUpdate();
                },1000);
            }).catch(error => {
                console.log(error.response.data);
            });
        },
        bookingAuthFinish: function() {
            if (this.cardStatus) {
                let data    =   {
                    user_id: this.user.id,
                    organization_id: this.organization.id,
                    organization_table_list_id: this.table.id,
                    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                    time: this.date.time[ this.date.timeIndex ].time,
                    date: this.date.data,
                    price: this.organization.price,
                    card_id: this.cards[ this.cardIndex ].card_id
                };
                this.cardStatus =   false;
                this.cardError  =   false;
                axios.post("/api/booking/create", data)
                .then(response => {
                    let data = response.data;
                    if (data.hasOwnProperty('data')) {
                        window.open('/form/'+data.data.id,'_blank');
                        window.location.href    =   '/profile/history';
                    }
                }).catch(error => {
                    this.cardStatus =   true;
                    this.cardError  =   true;
                });
            }
        },
        setUser: function() {
            if (this.storage.token) {
                let user    =   JSON.parse(sessionStorage.user);
                this.status =   true;
                this.user   =   user;
                this.cardList();
            }
        },
        cardList: function() {
            axios.get('/api/card/user/'+this.user.id)
            .then(response => {
                this.cards  =   response.data;
            }).catch(error => {
                console.log(error.response.data);
            });
        }
    }
}
</script>

<style lang="scss">
.booking {
    &-arr {
        &-btn {
            background: #00a082;
            color: white;
            border-radius: 30px;
        }
    }
    &-empty {
        display: grid;
        grid-gap: 15px;
        &-icon {
            width: 70px;
            height: 70px;
            background: url('/img/logo/card.svg') no-repeat center;
            background-size: cover;
            margin: 0 auto 0 auto;
        }
        &-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            color: darkgrey;
        }
    }
    &-card {
        display: grid;
        grid-template-columns: 40px auto;
        grid-gap: 15px;
        background: rgb(250,250,250);
        border-radius: 10px;
        padding: 10px 15px 10px 15px;
        cursor: pointer;
        color: grey;
        &:hover, &-sel {
            background: #FF8008;
            color: #fff;
        }
        &-list {
            display: grid;
            gap: 15px;
        }
        &-icon {
            width: 40px;
            background: url('/img/logo/card.svg') no-repeat center;
            background-size: contain;
        }
        &-detail {
            &-title {
                font-size: 18px;
                font-weight: bold;
            }
            &-num {
                font-size: 12px;
            }
        }
    }
    &-date {
        display: grid;
        grid-template-columns: 40px auto 40px;
        grid-gap: 10px;
        padding: 5px;
        background: rgb(250,250,250);
        border-radius: 40px;
    }
    &-time {
        display: grid;
        grid-template-columns: repeat(5,auto);
        gap: 10px;
        &-item {
            float: left;
            padding: 10px 0 10px 0;
            border-right: 30px;
            background: rgb(250,250,250);
            text-align: center;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            &:hover, &-sel {
                background: #00a082;
                color: #fff;
            }
        }
    }
    &-input {
        color: #00a082;
        outline: none !important;
        font-size: 20px;
        background: transparent;
    }
}
a {
    text-decoration: none;
    display: inline-block;
    padding: 8px 16px;
}

.round {
    border-radius: 50%;
}
</style>
