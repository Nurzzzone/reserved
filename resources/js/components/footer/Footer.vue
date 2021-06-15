<template>
    <div class="container-fluid pt-5 text-white" style="background: #1d1d1d;">
        <div class="container pb-5">
            <div class="row mb-5">
                <div class="col-6 col-md-6 col-lg-3">
                    <h3 class="font-weight-bold">Reserved</h3>
                    <h6 class="mt-3">Скачайте приложение</h6>
                    <div class="mt-4 main-thumbnail overflow-hidden">
                        <img src="/img/main/img-11.png" class="img-thumbnail bg-white p-0">
                    </div>
                    <div class="mt-3 main-thumbnail overflow-hidden">
                        <img src="/img/main/img-10.png" class="img-thumbnail bg-white p-0">
                    </div>
                    <h6 class="mt-4">©  Reserved 2020 - 2021</h6>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <h5 class="font-weight-bold mt-4">Давайте сделаем это вместе</h5>
                    <ul class="list-group p-0 mt-4">
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Для ресторанов</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Для компании</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Вакансии</li>
                    </ul>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <h5 class="font-weight-bold mt-4">Ссылки Reserved</h5>
                    <ul class="list-group p-0 mt-4">
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Контакты</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Поддержка</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Безопасность</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">О нас</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Блог</li>
                    </ul>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <h5 class="font-weight-bold mt-4">Мы в соц-сетях</h5>
                    <ul class="list-group p-0 mt-4">
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Facebook</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Instagram</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Youtube</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">Twitter</li>
                        <li class="list-group-item bg-transparent border-0 px-0 py-2">LinkedIn</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <div class="container">
      <div class="row fixed-bottom bg-white width-auto footer-fixed d-flex justify-content-center">
        <div class="col-12 col-md-4">
          <div class="footer-fixed-main w-100">
            <a href="/">
              <button class="btn p-3 font-weight-bold w-25">
                <img src="/img/logo/home.svg" width="20" height="20">
                <div class="mt-1 title">Главная</div>
              </button>
            </a>
            <a href="/top">
              <button class="btn p-3 font-weight-bold w-25">
                <img src="/img/logo/star.svg" width="20" height="20">
                <div class="mt-1 title">Топ</div>
              </button>
            </a>
            <a href="/favorite">
              <button class="btn p-3 font-weight-bold w-25">
                <img src="/img/logo/favorite.svg" width="20" height="20">
                <div class="mt-1 title">Избранное</div>
              </button>
            </a>
            <a href="/profile">
              <button class="btn p-3 font-weight-bold w-25">
                <img src="/img/logo/profile.svg" width="20" height="20">
                <div class="mt-1 title">Профиль</div>
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang="scss">
  .title {
    color: #00a082;
  }
    .main {
        &-thumbnail {
            max-width: 160px;
            border-radius: 5px;
        }
    }
    .footer {
        &-fixed {
          box-shadow: 0 0 10px 0 rgba(0,0,0,.3);
            &-main {

            }
        }
    }
</style>
