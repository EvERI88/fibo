import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createWebHistory, createRouter } from "vue-router";
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
    afterEnter: (to: any, from: any, next: any) => {
      const userStore = useUserStore();
      const basketStore = useBasketStore();

      if (!userStore.user?.id || basketStore.basket.items.length < 1) {
        next(false);
      } else {
        next();
      }
    },
  },
  {
    path: "/order",
    component: () => import("./components/Order/Order.vue"),
    name: "order",
    afterEnter: (to: any, from: any, next: any) => {
      const userStore = useUserStore();

      if (!userStore.user?.id) {
        next(false);
      } else {
        next();
      }
    },
  },
  {
    path: "/personal",
    component: () => import("./components/Personal/Personal.vue"),
    name: "personal",
    afterEnter: (to: any, from: any, next: any) => {
      const userStore = useUserStore();

      if (!userStore.user?.id) {
        next(false);
      } else {
        next();
      }
    },
  },
  {
    path: "/personal-order",
    component: () => import("./components/Personal/PersonalOrders.vue"),
    name: "personal-order",
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(pinia).use(router).mount("#app");
