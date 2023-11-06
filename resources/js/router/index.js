import {createWebHistory, createRouter} from "vue-router";

const routes = [
    {path: "/index", component: () => import('../Pages/Index.vue'), name: 'pages.index'},
    {path: "/message", component: () => import('../Pages/Message/Index.vue'), name: 'message.index'},
    {path: "/users/:id", component: () => import('../Pages/User/Show.vue'), name: 'user.show'},
    {path: "/test", component: () => import('../Pages/Test.vue'),},
    {path: "/login", component: () => import('../Pages/Login.vue'), name: 'auth.login',},
    {path: '/:catchAll(.*)', component: () => import("../Pages/NotFound.vue"), name: "pages.not-found"}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const accessToken = localStorage.getItem("access_token");
    const isAuthPages = ['auth.login'].includes(to.name);

    if (!accessToken) {
        if (isAuthPages) {
            return next();
        } else {
            return next({name: "auth.login"})
        }
    }

    if (isAuthPages && accessToken) {
        return next({name: "pages.index"})
    }

    next();
})

export default router;
