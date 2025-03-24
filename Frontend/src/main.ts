import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createMemoryHistory, createRouter } from "vue-router";
import MainPage from "./components/MainPage.vue";
import { createPinia } from "pinia";
import { useUserStore } from "../stores/useUserStore.ts";
import { useBasketStore } from "../stores/useBasketStore.ts";

const pinia = createPinia();
const routes = [
  { path: "/", component: MainPage, name: "main" },
  {
    path: "/contacts",
    component: () => import("./components/Contacts.vue"),
  },
  {
    path: "/basket",
    component: () => import("./components/Basket/Basket.vue"),
    name: "basket",
    beforeEnter: () => {
      if (!useUserStore().user?.id || useBasketStore().basket.items.length < 1)
        return false;
    },
  },
  {
    path: "/order",
    component: () => import("./components/Order/Order.vue"),
    name: "order",

    beforeEnter: () => {
      if (!useUserStore().user?.id) return false;
    },
  },
  {
    path: "/personal",
    component: () => import("./components/Personal/Personal.vue"),
    beforeEnter: () => {
      if (!useUserStore().user?.id) return false;
    },
    name: "personal",
  },
  {
    path: "/personal-order",
    component: () => import("./components/Personal/PersonalOrders.vue"),
    name: "personal-order",
  },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});

createApp(App).use(router).use(pinia).mount("#app");
