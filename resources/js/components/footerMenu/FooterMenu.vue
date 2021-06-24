<template>
    <div class="container d-md-none">
        <div class="row fixed-bottom bg-white width-auto footer-fixed d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <div class="footer-fixed-main w-100">
                    <a href="/home">
                        <button class="btn py-3 font-weight-bold w-25">
                            <img src="/img/logo/home.svg" width="20" height="20">
                            <div class="title">Главная</div>
                        </button>
                    </a>
                    <a href="/top">
                        <button class="btn py-3 font-weight-bold w-25">
                            <img src="/img/logo/star.svg" width="20" height="20">
                            <div class="title">Топ</div>
                        </button>
                    </a>
                    <a href="/favorite">
                        <button class="btn py-3 font-weight-bold w-25">
                            <img src="/img/logo/favorite.svg" width="20" height="20">
                            <div class="title">Избранное</div>
                        </button>
                    </a>
                    <a href="/profile">
                        <button class="btn py-3 font-weight-bold w-25">
                            <img src="/img/logo/profile.svg" width="20" height="20">
                            <div class="title">Профиль</div>
                        </button>
                    </a>
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
    .title {
        font-size: 12px;
        margin-top: 2px;
    }
</style>
