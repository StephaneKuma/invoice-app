<template>
    <div>
        <h1>Login</h1>

        <form @submit.prevent="login">
            <input type="email" name="email" v-model="email">

            <input type="password" name="password" v-model="password">

            <button type="submit">Send</button>
        </form>

        <h1>Token : {{ token }}</h1>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from 'axios';
import { useAuthStore } from "../store/auth";
import { storeToRefs } from "pinia";

const authStore = useAuthStore();
const { token } = storeToRefs(authStore);

const email = ref('');
const password = ref('');

const login = async () => {
    const data = {
        email: email.value,
        password: password.value,
    };

    const response = await axios.post('api/v1/login', data);

    if (response.status === 200) {
        token.value = response.data.token;
        localStorage.setItem('token', response.data.token);
    }

};
</script>
