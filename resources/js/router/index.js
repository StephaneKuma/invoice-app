import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("@/views/Home.vue"),
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: "/login",
        name: "login",
        component: () => import("@/views/Login.vue"),
    },
];

const router = createRouter({
    routes,
    history: createWebHistory(import.meta.env.BASE_URL),
});

router.beforeEach((to, from, next) => {
    if (to.name === "login" && localStorage.getItem("token") !== undefined) {
        next({ name: "home" });
    } else if (
        to.meta.requiresAuth &&
        localStorage.getItem("token") !== undefined
    ) {
        next();
    } else {
        next({ name: "login" });
    }
});

export default router;
