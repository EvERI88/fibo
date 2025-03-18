<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<script setup lang="ts">
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import { onMounted } from "vue";
import { useUserStore } from "../stores/useUserStore.ts";
import { useBasketStore } from "../stores/useBasketStore.ts";

const userStore = useUserStore();
const basketStore = useBasketStore();

const baseUrl: string = "http://api.fibo.local/";

const getCookie = (name = "token") => {
  let cookie = document.cookie
    .split("; ")
    .find((row) => row.startsWith(name + "="));
  return cookie ? cookie.split("=")[1] : null;
};

const checkBasket = () => {
  basketStore.basket = JSON.parse(localStorage.getItem("basket") ?? "");
};

const getToken = async () => {
  const token = getCookie() ?? "";

  const tokenParts = token.split(".");
  const decodedPayload = JSON.parse(atob(tokenParts[1]));
  const decodeSub: string = decodedPayload["sub"];
  try {
    await fetch(`${baseUrl}user/check-token`, {
      method: "POST",
      body: JSON.stringify({ token: token, id: decodeSub }),
      mode: "cors",
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data["user"]) {
          userStore.user = data["user"];
          checkBasket();
        } else {
          document.cookie = `token=`;
        }
      });
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  getToken();
});
</script>
