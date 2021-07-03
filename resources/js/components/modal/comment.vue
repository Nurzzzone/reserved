<template>
    <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="comment_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content auth-modal">
                <div class="modal-body" onselectstart="return false">
                    <div class="form-group d-flex justify-content-end">
                        <button class="auth-btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-group">
                        <h3 class="auth-title text-center">Отзыв</h3>
                        <h6 class="text-secondary text-center mt-3">Оставьте ваш отзыв, какое у вас было впечетеление.</h6>
                    </div>
                    <div class="form-group star-list">
                        <div class="star-icon" :class="{'star-icon-selected':(stars >= 1)}" @click="stars = 1"></div>
                        <div class="star-icon" :class="{'star-icon-selected':(stars >= 2)}" @click="stars = 2"></div>
                        <div class="star-icon" :class="{'star-icon-selected':(stars >= 3)}" @click="stars = 3"></div>
                        <div class="star-icon" :class="{'star-icon-selected':(stars >= 4)}" @click="stars = 4"></div>
                        <div class="star-icon" :class="{'star-icon-selected':(stars === 5)}" @click="stars = 5"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="star-comment" maxlength="255" rows="4" v-model="comment"></textarea>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-12">
                            <button class="btn btn-block auth-register text-white" @click="leaveComment()">Оставить отзыв</button>
                        </div>
                    </div>
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
            stars: 5,
            comment: ''
        }
    },
    methods: {
        leaveComment: function() {
            console.log(this.item);
        }
    }
}
</script>

<style lang="scss">
    .star {
        &-list {
            display: flex;
            gap: 15px;
            margin: 20px auto 0 auto;
            width: min-content;
        }
        &-icon {
            width: 30px;
            height: 30px;
            background: url('/img/logo/star-grey.svg') no-repeat center;
            background-size: contain;
            cursor: pointer;
            opacity: .5;
            &-selected {
                opacity: 1;
                background-image: url('/img/logo/star-orange.svg');
            }
        }
        &-comment {
            margin: 20px auto 0 auto;
            width: 100%;
            border: 2px solid rgb(0,130,100);
            resize: none;
            outline: none !important;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            overflow: hidden;
            background: #00a082;
            color: #fff;
        }
    }
</style>
