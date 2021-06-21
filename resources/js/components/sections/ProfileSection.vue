<template>
    <div class="container-fluid pt-5 top-bg">
        <div class="container pt-5 pb-4">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white top-title" v-if="url === 'profile'">Профиль</h1>
                    <h1 class="text-white top-title" v-else-if="url === 'settings'">Настройки</h1>
                    <h1 class="text-white top-title" v-else-if="url === 'payments'">Способ оплаты</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <div class="d-flex justify-content-center align-items-center">
                        <h5 class="m-0 mr-3 text-white font-weight-bold">Azim Tulendiev</h5>
                        <div class="avatar">
                            <div class="avatar-img bg-white rounded-circle">
                                <div class="font-weight-bold">A</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid top-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card text-center border-0 rounded-0 bg-transparent">
                        <div class="card-header top-bg border-0 d-flex justify-content-center">
                            <ul class="nav nav-tabs card-header-tabs border-0 font-weight-bold">
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile" :class="{ active: (url==='profile'?true:false),disabled: (url==='profile'?true:false),'text-white': (url!=='profile'?true:false) }">
                                        <img src="/img/logo/profile-white.svg" width="20" height="20" class="d-md-none">
                                        <span class="d-sm-none d-md-block">Профиль</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile/settings" :class="{ active: (url==='settings'?true:false),disabled: (url==='settings'?true:false),'text-white': (url!=='settings'?true:false) }">Настройки</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white border-0" href="/profile/history">История</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link border-0" href="/profile/payments" :class="{ active: (url==='payments'?true:false),disabled: (url==='payments'?true:false),'text-white': (url!=='payments'?true:false) }">Способ оплаты</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white border-0" href="/profile/support">Служба Поддержки</a>
                                </li>
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
    name: "ProfileSection",
    data() {
        return {
            url: 'profile'
        }
    },
    created() {
        let path    =   window.location.pathname.split('/');
        this.url    =   path[ path.length - 1 ];
    }
}
</script>

<style scoped>

</style>
