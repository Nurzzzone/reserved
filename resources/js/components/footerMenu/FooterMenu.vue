<template>
    <div class="container d-md-none">
        <div class="row bg-white width-auto footer-fixed d-flex justify-content-center">
            <div class="col-12 col-md-4 p-0">
                <div class="footer-fixed-main w-100">
                    <a href="/home" class="p-0 py-1 w-25">
                        <button class="btn font-weight-bold w-100">
                            <img src="/img/logo/home.svg" width="20" height="20">
                            <div class="title">Категории</div>
                        </button>
                    </a>
                    <a href="/top" class="p-0 py-1 w-25">
                        <button class="btn font-weight-bold w-100">
                            <img src="/img/logo/star.svg" width="20" height="20">
                            <div class="title">Топ</div>
                        </button>
                    </a>
                    <a href="/favorite" class="p-0 py-1 w-25">
                        <button class="btn font-weight-bold w-100">
                            <img src="/img/logo/favorite.svg" width="20" height="20">
                            <div class="title">Избранное</div>
                        </button>
                    </a>
                    <template v-if="storage.token !== ''">
                        <a href="/profile" class="p-0 py-1 w-25">
                            <button class="btn font-weight-bold w-100">
                                <img src="/img/logo/profile.svg" width="20" height="20">
                                <div class="title">Профиль</div>
                            </button>
                        </a>
                    </template>
                    <template v-else>
                        <a class="p-0 py-1 w-25" data-toggle="modal" data-target="#auth_modal">
                            <button class="btn font-weight-bold w-100">
                                <img src="/img/logo/profile.svg" width="20" height="20">
                                <div class="title">Профиль</div>
                            </button>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FooterMenu"
}
</script>

<style lang="scss">
    @import '../../../css/footerMenu/footerMenu.scss';
</style>
