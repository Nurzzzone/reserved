<template>
    <Header></Header>
    <div class="container-fluid search pt-5">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 col-12 search-left">
                    <div>
                        <img src="/img/main/img.png" width="100%">
                    </div>
                </div>
                <div class="col-md-6 col-12 search-right">
                    <div>
                        <div class="search-title text-white text-center font-weight-bold">Food delivery and more</div>
                        <div class="h6 text-white text-center mt-4">Groceries, shops, pharmacies, anything!</div>
                        <div class="search-input mt-4">
                            <div class="search-input-main">
                                <input type="text" class="w-100 shadow">
                            </div>
                            <button class="search-input-btn">Поиск</button>
                        </div>
                        <div class="search-current-location mt-4 text-white text-center d-table mx-auto">или найдите популярные рестораны в городе Алматы</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid wave">
        <svg viewBox="0 0 500 50" preserveAspectRatio="xMinYMin meet">
            <path d="M0,25 C150,50 350,0 500,25 L500,00 L0,0 Z" style="stroke: none; fill: #4ca1af;"></path>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="top-head">Top restaurants and more in Reserved</div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-6 col-md-3 p-3" v-for="(item,key) in top" :key="key">
                <div class="card border-0 shadow top-card overflow-hidden">
                    <div>
                        <img class="card-img-top" :src="item.img" width="100%" height="150">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ item.title }}</h5>
                        <p class="card-text">Some quick example text to build on the card title.</p>
                        <a href="#" class="btn btn-primary btn-block top-btn">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="top-head">Откройте города, где доступен Reserved</div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <div class="card text-center border-0">
                    <div class="card-header bg-transparent d-flex justify-content-center">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active">Казахстан</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">Другие страны</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3 p-3" v-for="(city,id) in location.countries[location.country]['list']" :key="id">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-body">{{city.title}}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Header from "./header/Header";
export default {
    components: {
        Header
    },
    name: "Home",
    data() {
        return {
            top: [
                {
                    img: '/img/main/img.jpg',
                    title: 'McDonald\'s',
                },
                {
                    img: '/img/main/img-1.jpg',
                    title: 'KFC',
                },
                {
                    img: '/img/main/img-2.jpg',
                    title: 'Burger King',
                },
                {
                    img: '/img/main/img-3.jpg',
                    title: 'Subway',
                },
                {
                    img: '/img/main/img-4.jpg',
                    title: 'Pizza Hut',
                },
                {
                    img: '/img/main/img-5.jpg',
                    title: 'Taco Bell',
                },
                {
                    img: '/img/main/img-6.jpg',
                    title: 'Papa John\'s',
                },
                {
                    img: '/img/main/img-7.jpg',
                    title: 'Dunkin Donuts',
                },
            ],
            location: {
                country: 0,
                countries: [
                    {
                        title: 'Kazakhstan',
                        list: [
                            {
                                title: 'Almaty',
                            },
                            {
                                title: 'Nur-Sultan',
                            },
                            {
                                title: 'Semey',
                            },
                            {
                                title: 'Aktau',
                            },
                            {
                                title: 'Karaganda',
                            },
                        ]
                    }
                ]
            }
        }
    }
}
</script>

<style lang="scss">
    .top {
        &-head {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            font-family: 'Work Sans', sans-serif;
        }
        &-card {
            border-radius: 35px;
        }
        &-btn {
            border-radius: 30px;
        }
    }
    .search {
        background-color: #4ca1af;
        min-height: 550px;
        &-right, &-left {
            display: flex;
            justify-content: center;
            padding: 0 50px 0 50px;
        }
        &-current {
            &-location {
                border-bottom: 1px solid white;
                cursor: pointer;
            }
        }
        &-title {
            font-size: 64px;
            line-height: 1;
        }
        &-input {
            display: grid;
            grid-template-columns: auto 100px;
            grid-gap: 10px;
            font-size: 13px;
            &-btn {
                height: 44px;
                border-radius: 30px;
                border: none;
                font-weight: bold;
                background-color: #FF8008;
                color: #fff;
            }
            &-main {
                & > input {
                    border-radius: 50px;
                    height: 100%;
                    border: none;
                    outline: none;
                }
            }
        }
    }
    .wave {
        padding: 0 !important;
    }
</style>
