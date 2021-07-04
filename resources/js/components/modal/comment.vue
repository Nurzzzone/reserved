<template>
    <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="comment_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content auth-modal overflow-hidden comment-main">
                <div class="modal-body p-0" onselectstart="return false">
                    <div class="form-group d-flex justify-content-end comment-close">
                        <button class="auth-btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-group m-0" v-if="item.organization">
                        <div class="comment-wallpaper">
                            <img :src="item.organization.wallpaper" :alt="item.organization.title">
                        </div>
                        <div class="comment-logo">
                            <img :src="item.organization.image" :alt="item.organization.title">
                        </div>
                    </div>
                    <div class="form-group comment-bg m-0" v-if="item.organization">
                        <div class="comment-organization">
                            <div class="comment-organization-title">{{item.organization.title}}</div>
                            <div class="comment-organization-detail">
                                <div class="comment-organization-detail-table">{{item.organization_tables.title}}</div>
                                <div class="comment-organization-detail-arrow"></div>
                                <div class="comment-organization-detail-date">{{item.date}}</div>
                                <div class="comment-organization-detail-arrow"></div>
                                <div class="comment-organization-detail-date">{{item.time}}</div>
                            </div>

                        </div>
                    </div>
                    <template v-if="storage.modal">
                        <div class="form-group comment-bg m-0">
                            <div class=" star-list">
                                <div class="star-icon" :class="{'star-icon-selected':(stars >= 1)}" @click="stars = 1">
                                    <div></div>
                                </div>
                                <div class="star-icon" :class="{'star-icon-selected':(stars >= 2)}" @click="stars = 2">
                                    <div></div>
                                </div>
                                <div class="star-icon" :class="{'star-icon-selected':(stars >= 3)}" @click="stars = 3">
                                    <div></div>
                                </div>
                                <div class="star-icon" :class="{'star-icon-selected':(stars >= 4)}" @click="stars = 4">
                                    <div></div>
                                </div>
                                <div class="star-icon" :class="{'star-icon-selected':(stars === 5)}" @click="stars = 5">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-0 comment-bg py-0 p-4" style="padding-top: 0 !important;padding-bottom: 0 !important;">
                            <textarea class="star-comment" maxlength="255" rows="4" v-model="comment" ref="comment" :readonly="!status" placeholder="Оставьте ваш отзыв, какое у вас было впечетеление."></textarea>
                        </div>
                        <div class="form-row p-4 comment-bg m-0">
                            <div class="col-12 p-0">
                                <button class="btn btn-block auth-register text-white" @click="leaveComment">Оставить отзыв</button>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="col-12 pt-3 comment-bg">
                            <div class="form-group d-flex justify-content-center p-0 m-0">
                                <img src="/img/logo/gratitude.svg" width="100" class="m-0">
                            </div>
                        </div>
                        <div class="col-12 pt-3 comment-bg">
                            <div class="h6 text-center text-secondary m-0">Спасибо за отзыв! Ваш отзыв находиться на проверке у админинстратора.</div>
                        </div>
                        <div class="col-12 py-3 comment-bg">
                            <button class="btn btn-block auth-register text-white" data-dismiss="modal" aria-label="Close" >Закрыть</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['item'],
    name: "comment",
    data() {
        return {
            status: true,
            stars: 5,
            comment: ''
        }
    },
    methods: {
        newComment: function() {

        },
        leaveComment: function() {
            if (this.status) {
                if (this.comment.trim() === '') {
                    return this.$refs.comment.focus();
                }
                this.status =   false;
                axios.post("/api/review/create", {
                    booking_id: this.item.id,
                    organization_id: this.item.organization_id,
                    user_id: this.item.user_id,
                    rating: this.stars,
                    comment: this.comment.replace(/(\r\n|\r|\n){2}/g, '$1').replace(/(\r\n|\r|\n){3,}/g, '$1\n'),
                })
                    .then(response => {
                        this.status =   true;
                        this.rating =   5;
                        this.comment    =   '';
                        this.storage.modal  =   false;
                    }).catch(error => {
                        this.status =   true;
                    });
            }
        }
    }
}
</script>

<style lang="scss">
    @import '../../../css/modal/comment.scss';
</style>
