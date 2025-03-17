import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createMemoryHistory, createRouter } from "vue-router";
import MainPage from "./components/MainPage.vue";
import { createPinia } from "pinia";

const pinia = createPinia();
const routes = [
  { path: "/", component: MainPage },
  { path: "/contacts", component: () => import("./components/Contacts.vue") },
  { path: "/basket", component: () => import("./components/Basket/Basket.vue") },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});

createApp(App).use(router).use(pinia).mount("#app");
