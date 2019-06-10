<style scoped>
    .panel-block {
        flex-direction: column;
        border: none;
    }

    .chat {
        width: 100%;
        padding: 20px;
        box-shadow: inset 0 0 20px 0 grey;
        margin-bottom: 20px;
        border: 1px solid gray;
        max-height: 600px;
        overflow-x: auto;
    }

    .chat .chat-right, .chat .chat-left {
        max-width: 70%;
        box-shadow: 0 0 8px 0px gray;
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
        <div class="chat" v-if="chats.length > 0">
            <div v-for="chat in chats" style="overflow: auto">
                <div class="chat-right" v-if="chat.profile_id === profileid">
                    {{chat.chat}}
                </div>
                <div class="chat-left" v-else>
                    {{chat.chat}}
                </div>
            </div>
        </div>
        <div v-else class="no-message">
            There are no messages for you
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