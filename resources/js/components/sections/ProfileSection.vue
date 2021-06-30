<template>
    <div class="container-fluid section-bg">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-12" v-if="end === 'profile'">
                    <h1 class="text-white section-title" v-if="url === 'profile'">Профиль</h1>
                    <h1 class="text-white section-title" v-else-if="url === 'settings'">Настройки</h1>
                    <h1 class="text-white section-title" v-else-if="url === 'payments'">Способ оплаты</h1>
                    <h1 class="text-white section-title" v-else-if="url === 'history'">История</h1>
                </div>
                <div class="col-12" v-else-if="end === 'favorite'">
                    <h1 class="text-white section-title" v-if="url === 'favorite'">Избранное</h1>
                </div>
                <div class="col-12" v-else-if="end === 'top'">
                    <h1 class="text-white section-title" v-if="url === 'top'">Топ 10</h1>
                </div>
                <div class="col-12" v-else-if="end === 'home'">
                    <h1 class="text-white section-title" v-if="url === 'home'">Категории</h1>
                    <h1 class="text-white section-title" v-if="url === 'restaurants'">Рестораны</h1>
                    <h1 class="text-white section-title" v-if="url === 'cafe'">Кафе</h1>
                    <h1 class="text-white section-title" v-if="url === 'bars'">Бары</h1>
                    <h1 class="text-white section-title" v-if="name">{{name}}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid section-bg-main" v-if="end === 'profile'">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card text-center border-0 rounded-0 bg-transparent">
                        <div class="card-header top-bg border-0 d-flex justify-content-center">
                            <ul class="nav nav-tabs card-header-tabs border-0 font-weight-bold">
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile" :class="{ active: (url==='profile'?true:false),disabled: (url==='profile'?true:false),'text-white': (url!=='profile'?true:false) }">
                                        <img src="/img/logo/profile-white.svg" width="20" height="20" class="d-md-none" v-if="url!=='profile'">
                                        <img src="/img/logo/profile.svg" width="20" height="20" class="d-md-none" v-else>
                                        <span class="d-none d-md-block">Профиль</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile/settings" :class="{ active: (url==='settings'?true:false),disabled: (url==='settings'?true:false),'text-white': (url!=='settings'?true:false) }">
                                        <img src="/img/logo/settings-white.svg" width="20" height="20" class="d-md-none" v-if="url!=='settings'">
                                        <img src="/img/logo/settings.svg" width="20" height="20" class="d-md-none" v-else>
                                        <span class="d-none d-md-block">Настройки</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile/history" :class="{ active: (url==='history'?true:false),disabled: (url==='history'?true:false),'text-white': (url!=='history'?true:false) }">
                                        <img src="/img/logo/history-white.svg" width="20" height="20" class="d-md-none" v-if="url!=='history'">
                                        <img src="/img/logo/history.svg" width="20" height="20" class="d-md-none" v-else>
                                        <span class="d-none d-md-block">История</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile/payments" :class="{ active: (url==='payments'?true:false),disabled: (url==='payments'?true:false),'text-white': (url!=='payments'?true:false) }">
                                        <img src="/img/logo/wallet-white.svg" width="20" height="20" class="d-md-none" v-if="url!=='payments'">
                                        <img src="/img/logo/wallet.svg" width="20" height="20" class="d-md-none" v-else>
                                        <span class="d-none d-md-block">Способ оплаты</span>
                                    </a>
                                </li>
                                <!--
                                <li class="nav-item">
                                    <a class="nav-link text-white border-0" href="/profile/support" :class="{ active: (url==='support'?true:false),disabled: (url==='support'?true:false),'text-white': (url!=='support'?true:false) }">
                                        <img src="/img/logo/help-white.svg" width="20" height="20" class="d-md-none" v-if="url!=='support'">
                                        <img src="/img/logo/help.svg" width="20" height="20" class="d-md-none" v-else>
                                        <span class="d-none d-md-block">Служба Поддержки</span>
                                    </a>
                                </li>
                                -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['name'],
    name: "ProfileSection",
    data() {
        return {
            url: 'profile',
            end: '',
        }
    },
    created() {
        this.setEnd();
    },
    methods: {
        setEnd: function() {
            let path    =   window.location.pathname.split('/');
            this.url    =   path[ path.length - 1 ];
            let length  =   path.length;
            for (let i = 0; i < length; i++) {
                if (path[i].trim() !== '') {
                    this.end    =   path[i];
                    break;
                }
            }
        },
    }
}
</script>

<style lang="scss">
  @import '../../../css/sections/profileSection.scss';
</style>
