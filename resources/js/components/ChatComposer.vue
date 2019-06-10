<template>
    <div>
        <div>
            <input type="text" v-on:keyup.enter="sendChat" v-model="chat">
        </div>
        <div>
            <input type="submit" class="button" value="SEND" v-on:click="sendChat">
        </div>
    </div>
</template>

<script>
    export default {
        // name: "ChatComposer",
        props: ['chats', 'profileid', 'friendid'],
        data() {
            return {
                chat: ''
            }
        },
        methods: {
            sendChat: function (e) {
                if (this.chat != '') {
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        profile_id: this.profileid,
                    };
                    this.chat = '';
                    axios.post('sendChat', data).then((response) => {
                        this.chats.push(data)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>