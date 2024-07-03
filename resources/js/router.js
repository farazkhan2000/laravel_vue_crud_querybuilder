import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/Home.vue"),
    },
    {
        path: "/students",
        component: () => import("./pages/Students.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});