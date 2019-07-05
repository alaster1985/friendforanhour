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
                        created_at: (new Date()).toISOString().split('T')[0] +' '+ (new Date()).toISOString().split('T')[1].split('.')[0],
                    };
                    this.chat = '';
                    axios.post('sendChat', data).then((response) => {
                        this.chats.push(data);
                        setTimeout(() => {
                            var chatt = document.getElementById('chatt');
                            chatt.scrollTop = chatt.scrollHeight}, 100)
                    })
                }
            }
        }
    }
</script>

<style scoped>

</style>