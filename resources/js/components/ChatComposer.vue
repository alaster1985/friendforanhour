<template>
    <div>
        <div>
            <textarea cols="68" rows="3" v-on:keyup.enter="sendChat" v-model="chat"></textarea>
        </div>
        <div style="text-align: right;">
            <input type="submit" class="btn btn-primary" value="Отправить" v-on:click="sendChat" >
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
textarea {

    margin: 20px 0;
        width: 100%;
    color: #465160;
    padding: 3px 9px 8px;
    border: none;
/*    border: solid 1px #D5D5D5;
    border-bottom-color: #DEDEDE;
    border-top-color: #C0C0C0;*/
    border-radius: .25rem;
    background: #FFF;
    /*box-shadow: inset 0 1px 1px rgba(0,0,0,0.1);*/
    box-shadow: 1px 1px 7px -3px rgba(0,0,0,0.75);
}
.button {
    text-shadow: -1px -1px 0 #0D79BD;
    border: solid 1px #037BC6;
    border-bottom-color: #07598D;
    border-top-color: #0285D8;
    background-color: #009CFF !important;
    background: linear-gradient(to bottom, #009cff 0%,#0d79bd 75%,#019cfe 100%);
}
</style>