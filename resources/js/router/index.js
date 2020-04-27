import Vue from "vue";
import VueRouter from "vue-router";

import PizzaList from "../views/PizzaList.vue";
import PizzaShow from "../views/PizzaShow.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "PizzaList",
        component: PizzaList
    },
    {
        path: "/pizza/:id",
        name: "PizzaShow",
        component: PizzaShow
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;
