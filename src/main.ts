import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createMemoryHistory, createRouter } from "vue-router";
import MainPage from "./components/MainPage.vue";

const routes = [
  { path: "/", component: MainPage },
  { path: "/contacts", component: () => import("./components/Contacts.vue") },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});

createApp(App).use(router).mount("#app");
