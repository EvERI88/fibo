<template>
  <Header />
  <RouterView />
  <Footer />
</template>

<script setup lang="ts">
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import { onMounted, ref, watchEffect } from "vue";

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
  const userId = localStorage.getItem("id");

  try {
    await fetch(`${baseUrl}user/check-token`, {
      method: "POST",
      body: JSON.stringify({ token: token, id: userId }),
      mode: "cors",
    })
      .then((response) => {
        console.log(response);
        return response.json();
      })
      .then((data) => {
        data["token-status"] === "valid"
          ? (validToken.value = true)
          : (validToken.value = false);
      });
  } catch (err) {
    console.log(err);
  }
};

const onLeave = () => {
  if (!validToken.value) {
    console.log("Тут будет редирект");
  }
};

watchEffect(onLeave);

onMounted(() => {
  getToken();
});
</script>
