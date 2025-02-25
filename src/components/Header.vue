<template>
  <header class="header">
    <RouterLink to="/" class="header__logo">
      <Logo />
    </RouterLink>
    <HeaderInfo />
    <HeaderFeedback />
  </header>
</template>
<script setup lang="ts">
import { RouterLink } from "vue-router";
import Logo from "./UI/Logo.vue";
import HeaderInfo from "./Header/HeaderInfo.vue";
import HeaderFeedback from "./Header/HeaderFeedback.vue";
</script>
<style lang="scss">
.header {
  display: flex;
  justify-content: left;
  padding: 7px 0px;
  align-items: center;
  justify-content: space-between;
  &__info {
    display: flex;
    flex-direction: column;
  }
  .info {
    &__time-stars {
      display: flex;
      flex-direction: row;
      gap: 20px;
    }
    &__time-stars::before {
      
    }
  }
}
</style>
