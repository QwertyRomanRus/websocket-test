<template>
    <div v-if="token" class="flex">
        <router-link to="/test" class="mx-3">test</router-link>
        <router-link to="/index" class="mx-3">index</router-link>
        <router-link :to="{name: 'message.index'}" class="mx-3">message</router-link>
        <div class="mx-2 text-red-500" v-if="token">
            Name: {{ user.name }}
        </div>
    </div>

    <router-view></router-view>
</template>

<script>
import api from "./api.js";

export default {
    name: "App",
    data() {
        return {
            token: localStorage.getItem('access_token'),
            user: {},
        }
    },

    methods: {
        getUser() {
            api.get('/api/v1/me').then(res => {
                this.user = res.data
                localStorage.setItem('user_id', res.data.id)
            })
        }
    },

    mounted() {
        if (this.token) {
            this.getUser();
        }
    }
}
</script>

<style scoped>

</style>
