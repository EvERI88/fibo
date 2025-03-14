<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<script setup lang="ts">
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import { onMounted, ref } from "vue";
import { useUserStore } from "../stores/useUserStore.ts";

const userStore = useUserStore();

interface User {
  id: number;
  name: string;
  telephone: string;
}

const user = <User>userStore.user;

const baseUrl: string = "http://api.fibo.local/";

const validToken = ref<Boolean>(false);

const getCookie = (name = "token") => {
  let cookie = document.cookie
    .split("; ")
    .find((row) => row.startsWith(name + "="));
  return cookie ? cookie.split("=")[1] : null;
};

const getToken = async () => {
  const token = getCookie();

  try {
    await fetch(`${baseUrl}user/check-token`, {
      method: "POST",
      body: JSON.stringify({ token: token }),
      mode: "cors",
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        data["token-status"] === "valid"
          ? (validToken.value = true)
          : (validToken.value = false);
        if (validToken.value) {
        } else {
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
