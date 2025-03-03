<template>
  <header class="header">
    <div class="header__wrapper">
      <RouterLink to="/" class="header__logo">
        <Logo />
      </RouterLink>
      <HeaderInfo />
      <Feedback class="header__feedback" />
    </div>
  </header>
  <BurgerMenu />
</template>
<script setup lang="ts">
import { RouterLink } from "vue-router";
import Logo from "./UI/Logo.vue";
import HeaderInfo from "./Header/HeaderInfo.vue";
import Feedback from "./UI/Feedback.vue";
import BurgerMenu from "./Header/BurgerMenu.vue";
</script>
<style lang="scss">
.header {
  display: flex;
  justify-content: center;
  padding-top: 1rem;

  &__wrapper {
    max-width: 1110px;
    width: 100%;
    display: flex;
  }

  .main-logo {
    min-width: 80px;
    min-height: 60px;
    flex: 0 0 auto;
  }
  &__col-yellow {
    color: var(--col-yellow);
  }

  &__feedback {
    align-items: center;
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
