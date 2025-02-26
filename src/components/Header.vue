<template>
  <header class="header">
    <RouterLink to="/" class="header__logo">
      <Logo />
    </RouterLink>
    <HeaderInfo />
    <HeaderFeedback class="ai-center" />
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
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  flex-wrap: wrap;

  .main-logo {
    min-width: 80px;
    min-height: 60px;
    flex: 0 0 auto;
  }

  &__info {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    padding: 0 2%;
    min-width: 200px;
  }
  &__info--city {
    font-size: 1.2rem;
    padding-bottom: 0.5rem;
  }

  &__info-time-stars {
    display: flex;
    flex-direction: row;
    gap: 1rem;
    font-size: 0.9rem;
    align-items: center;
  }
  &__info-time-stars-ya {
    max-width: 18px;
    border-radius: 10px;
  }
  &__info-time-stars-circle {
    position: relative;
  }
  &__info-time-stars-circle::before {
    position: absolute;
    content: "";
    width: 4px;
    height: 4px;
    background-color: #ff2e65;
    border-radius: 50%;
    right: -10px;
    top: 50%;
  }

  &__feedback {
    display: flex;
    flex: 0 0 auto;
    gap: 1rem;
  }
  &__feedback--telephone-btn {
    background: #f3f3f7;
    color: #696f7a;
    border-radius: 28px;
    padding: 0 1.5rem;
    font-weight: 700;
    font-size: 0.9rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
  }

  &__feedback--telephone-text {
    font-family: Montserrat, sans-serif;
    font-weight: 700;
    font-size: 1.5rem;
    line-height: 1.2;
    white-space: nowrap;
  }

  @media (max-width: 768px) {
    flex-direction: column;
    align-items: flex-start;

    .main-logo {
      margin-bottom: 1rem;
    }

    &__info {
      padding: 0;
      margin-bottom: 1rem;
    }

    &__feedback {
      width: 100%;
      justify-content: space-between;
    }
  }

  @media (max-width: 480px) {
    .feedback {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.5rem;

      &__telephone-text {
        padding-left: 0;
      }
    }
  }
}
</style>
