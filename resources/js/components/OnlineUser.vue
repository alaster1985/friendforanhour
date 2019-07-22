<template>
    <div class="pull-right">
        <span v-if="checkUser()" class="green"><img src="/images/monitor1.svg">Онлайн</span>
        <span v-else class="red"><img src="/images/monitor0.svg">Офлайн</span>

        <!--<span v-if="checkUnreadMessages()" class="blue">You have new messages</span>-->
        <!--<span v-else></span>-->
    </div>
</template>

<script>
    export default {
        // name: "OnlineUser",
        props: ['friend', 'onlineusers'],
        methods: {
            checkUser: function () {
                return _.find(this.onlineusers, {profile_id: this.friend.id})
            },
            // checkUnreadMessages: function () {
            //     return check(this.friend.id);
            // }
        }
    }
    // function check(id) {
    //     $.get('checkUnreadMessages/' + id, function (data) {
    //         if (data != null){
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     })
    // }
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
    /*.blue {*/
        /*color: dodgerblue;*/
    /*}*/
</style>