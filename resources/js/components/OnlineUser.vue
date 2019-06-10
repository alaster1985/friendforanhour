<template>
    <div class="pull-right">
        <i class="fa fa-circle green" v-if="checkUser()"></i>
        <i class="fa fa-circle red" v-else></i>
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
    .red {
    color: red;
    }
    .green {
        color: green;
    }
</style>