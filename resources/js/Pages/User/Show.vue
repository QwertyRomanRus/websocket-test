<template>
    <div class="w-96 m-auto">
        <div>
            name: {{ user.name }}
        </div>
        <div class="bg-sky-500 w-auto p-2 my-2 text-white border-xl text-center">
            <button @click.prevent="sendLike" class="w-[100%]">like</button>
        </div>
        <div v-if="likedString">
            {{ likedString }}
        </div>
    </div>
</template>

<script>
import api from "../../api.js";

export default {
    name: "Show",
    data() {
        return {
            user: {},
            likedString: '',
        }
    },

    methods: {
        getUser() {
            api.get(`/api/v1/users/${this.$route.params.id}`).then(res => {
                this.user = res.data.user
            })
        },

        sendLike() {
            api.get(`/api/v1/users/${this.user.id}/send-like`).then(res => {
                this.likedString = res.data.like_string;
            })
        },

    },

    created() {
        this.getUser();
    },

    mounted() {
        window.Echo.private(`send_like_${localStorage.getItem('user_id')}`)
            .listen('.send_like', (res) => {
                this.likedString = res.like_string;
            })
    }
}
</script>

<style scoped>

</style>
