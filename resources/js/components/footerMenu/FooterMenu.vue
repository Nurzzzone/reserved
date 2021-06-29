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
                    <a href="/profile" class="p-0 py-1 w-25">
                        <button class="btn font-weight-bold w-100">
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
        font-size: 9px;
        margin-top: 2px;
    }
    .footer {
        &-fixed {
            box-shadow: 0 0 5px 0 rgba(0,0,0,.1);
            position: fixed;
            right: 10px;
            bottom: 30px;
            left: 10px;
            z-index: 1030;
            margin: 0;
            border-radius: 50px;
            &-main {

            }
        }
    }
</style>
