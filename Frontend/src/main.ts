import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createMemoryHistory, createRouter } from "vue-router";
import MainPage from "./components/MainPage.vue";
import { createPinia } from "pinia";

const pinia = createPinia();
const routes = [
  { path: "/", component: MainPage, name: "main" },
  { path: "/contacts", component: () => import("./components/Contacts.vue") },
  {
    path: "/basket",
    component: () => import("./components/Basket/Basket.vue"),
    name: "basket",
  },
  {
    path: "/order",
    component: () => import("./components/Order/Order.vue"),
    name: "order",
  },
  {
    path: "/personal",
    component: () => import("./components/Personal/Personal.vue"),
    name: "personal",
  },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});

createApp(App).use(router).use(pinia).mount("#app");
