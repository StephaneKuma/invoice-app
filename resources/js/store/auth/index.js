import { defineStore } from "pinia";
import { ref } from "vue";

export const useAuthStore = defineStore("token", () => {
    const token = ref(undefined);

    return {
        token,
    };
});

