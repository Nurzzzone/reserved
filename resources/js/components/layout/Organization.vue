<template>
    <div class="container-fluid py-3 py-md-5 item-bg">
        <div class="container">
            <div class="row">
                <div class="col-6 col-xl-4 p-0 p-md-2" v-for="(organization,key) in organizations" :key="key">
                    <div class="card border-0 item-shadow overflow-hidden m-2 m-md-0 item-radius">
                        <div class="item-main">
                            <div class="favorite-category" :class="{'favorite-main-off':(!storage.favorite.includes(organization.id)),'favorite-main-on':(storage.favorite.includes(organization.id))}" @click="favorite(organization.id)"></div>
                            <div class="item-rating" v-if="organization.rating">
                                <span>{{organization.rating}}</span>
                            </div>
                            <img v-if="organization.wallpaper" :src="organization.wallpaper">
                            <img v-else src="/img/logo/wall.png">
                        </div>
                        <div class="item-logo mb-md-2 d-flex justify-content-center">
                            <div class="item-logo-default">
                                <img v-if="organization.image" :src="organization.image">
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-center p-0">
                                <a :href="'/home/'+organization.id" class="text-dark">
                                    <h3 class=" font-weight-bold item-title">{{organization.title}}</h3>
                                </a>
                                <p class="item-description text-secondary mx-3 my-0" v-if="organization.description">{{organization.description}}</p>
                            </li>
                            <li class="list-group-item text-center bg-light">
                                <div class="h6 text-secondary text-font" v-if="organization.timeTitle">{{organization.timeTitle}}</div>
                                <div class="text-center mb-0 mt-2 h6 text-secondary text-font">{{organization.address}}</div>
                            </li>
                            <li class="list-group-item">
                                <a :href="'/home/'+category.slug+'/'+organization.id" class="btn w-100 text-white text-btn text-font font-weight-bold d-flex justify-content-center align-content-center">
                                    <div class="py-md-1">Подробнее</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['category','organizations'],
    name: "Organization",
    methods: {
        favorite: function(id) {
            let len =   this.storage.favorite.length;
            let status  =   true;
            for (let i = 0; i < len; i++) {
                if (this.storage.favorite[i] === id) {
                    this.storage.favorite.splice(i,1);
                    status  =   false;
                }
            }
            if (status) {
                this.storage.favorite.push(id);
            }
        },
    }
}
</script>

<style lang="scss">

</style>
