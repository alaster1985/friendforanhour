<template>
    <div class="pull-right">
        <!--<i class="fa fa-circle green" v-if="checkUser()"></i>-->
        <!--<i class="fa fa-circle red" v-else></i>-->
        <span v-if="checkUser()" class="green"><img src="/images/monitor1.svg">Онлайн</span>
        <span v-else class="red"><img src="/images/monitor0.svg">Офлайн</span>
    </div>
</template>

<script>
    export default {
        // name: "OnlineUser",
        props: ['friend', 'onlineusers'],
        methods: {
            checkUser: function () {
                return _.find(this.onlineusers, {profile_id: this.friend.id})
            }
        }
    }
</script>

<style scoped>
    img {
        height: 15px;
    }
    .red {
    color: red;
    }
    .green {
        color: green;
    }
</style>