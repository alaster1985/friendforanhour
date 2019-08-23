<style scoped>
    .panel-block {
        flex-direction: column;
        /* border: none;*/

    }

    .chat {
        width: 100%;
        padding: 20px;
        /* box-shadow: inset 0 0 20px 0 grey;
         margin-bottom: 20px;*/
        /*border: 1px solid lightgrey;*/
        /*border-bottom: 1px solid lightgrey;*/
        max-height: 600px;
        overflow-x: auto;
        background: #fff;
        box-shadow: 0px 0px 19px -2px rgba(0,0,0,0.15);
    }
    .chat span {
        font-size: 8px;
    }

    .chat p {
        margin-bottom: -1px;
        color: #465160;
        font: 13px/20px Tahoma, Helvetica, sans-serif;
    }

    .chat .chat-right, .chat .chat-left {
        max-width: 70%;
        box-shadow: 0px 0px 19px -2px rgba(0,0,0,0.15);
        border-radius: .25rem;
        background: #f9f9f9;
        padding: 8px;
        margin: 4px;
    }


    .chat-right {
        float: right;
    }

    .chat-left {
        float: left;

    }

    .no-message {
        height: 200px;
        display: flex;
        align-items: center;
    }

</style>
<template>
    <div class="panel-block">
        <div id="chatt" class="chat" v-if="chats.length > 0">
            <div v-for="chat in chats" style="overflow: auto">
                <div class="chat-right" v-if="chat.profile_id === profileid">
                    <p>{{chat.chat}}</p>
                    <span>{{chat.created_at}}</span>
                </div>

                <div class="chat-left" v-else>
                    <p>{{chat.chat}}</p>
                    <span>{{chat.created_at}}</span>
                </div>
            </div>
        </div>
        <div v-else class="no-message">
            Для вас нет сообщений.
        </div>
        <chat-composer v-bind:profileid="profileid" v-bind:chats="chats" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    // export default {
    //     name: "Chat"
    // }
    export default {
        props: ['chats', 'profileid', 'friendid'],
    }
</script>

<style scoped>

</style>