<template>
    <div class="w-96 mx-auto">
        <div class="my-2">
            <textarea type="text" v-model="body" placeholder="type message"
                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300
              focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
              dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
        </div>
        <div class="bg-sky-500 w-auto p-2 my-2 text-white border-xl text-center">
            <button @click.prevent="sentMessage" class="w-[100%]">sent</button>
        </div>
        <div v-if="messages.length > 0">
            messages
            <div v-for="message in messages" class="border-t border-black my-3 py-3">
                <p class="my-1">{{ message.id }}</p>
                <p class="my-1">{{ message.body }}</p>
                <p class="my-1">{{ message.time }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../../api.js";

export default {
    name: "Index",
    data() {
        return {
            body: '',
            messages: []
        }
    },

    methods: {
        sentMessage() {
            api.post('/api/v1/messages', {body: this.body}).then(res => {
                this.messages.unshift(res.data.data);
                this.body = '';
            });
        },
        getMessages() {
            api.get('/api/v1/messages').then(res => {
                this.messages = res.data.data
            })
        },
    },

    mounted() {
        this.getMessages();
    },

    created() {
        window.Echo.channel('chat')
            .listen('.test-message', res => {
                this.messages.unshift(res.message)
            });
    }
}
</script>

<style scoped>

</style>
