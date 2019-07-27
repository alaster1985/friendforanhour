/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('chat-composer', require('./components/ChatComposer.vue').default);
Vue.component('online', require('./components/OnlineUser.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if ($('#chat-vue').length) {
    var app = new Vue({
        el: '#chat-vue',
        data: {
            chats: '',
            onlineUsers: ''
        },
        created() {
            const profile_Id = $('meta[name="profile_Id"]').attr('content');
            const friendId = $('meta[name="friendId"]').attr('content');

            if (friendId != undefined) {
                axios.post('getChat/' + friendId).then((response) => { // open chat ev
                    this.chats = response.data;
                    setTimeout(() => {
                        var chatt = document.getElementById('chatt');
                        chatt.scrollTop = chatt.scrollHeight}, 100)
                });

                Echo.private('Chat.' + friendId + '.' + profile_Id)
                    .listen('BroadcastChat', (e) => {
                        document.getElementById('chatAudio').play(); // receive ev
                        this.chats.push(e.chat);
                        $.get('setReadMark/'+ e.chat.profile_id, ()=>{});
                        setTimeout(() => {
                            var chatt = document.getElementById('chatt');
                            chatt.scrollTop = chatt.scrollHeight}, 100)
                    });
            }
            if (profile_Id != null) {
                Echo.join('Online')
                    .here((users) => {
                        this.onlineUsers = users;
                    })
                    .joining((user) => {
                        this.onlineUsers.push(user);
                    })
                    .leaving((user) => {
                        this.onlineUsers = this.onlineUsers.filter((u) => {u != user});
                    })
            }
        }
    });
}