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
  <BurgerMenu @openAuth="openAuth" :listNavigation="listNavigation" />
</template>
<script setup lang="ts">
import { RouterLink } from "vue-router";
import Logo from "./UI/Logo.vue";
import HeaderInfo from "./Header/HeaderInfo.vue";
import Feedback from "./UI/Feedback.vue";
import BurgerMenu from "./Header/BurgerMenu.vue";

interface navigation {
  id: number;
  name: string;
  anchor: string;
}

const listNavigation: navigation[] = [
  { id: 0, name: "Пицца", anchor: "Пицца" },
  { id: 1, name: "Паста", anchor: "Паста" },
  { id: 2, name: "Супы", anchor: "Супы" },
  { id: 3, name: "Салаты", anchor: "Салаты" },
  { id: 4, name: "Напитки", anchor: "Напитки" },
  { id: 5, name: "Десерты", anchor: "Десерты" },
  { id: 6, name: "Бакалея", anchor: "Бакалея" },
  { id: 7, name: "Антипасти", anchor: "Антипасти" },
  { id: 8, name: "Акции", anchor: "Акции" },
  { id: 9, name: "Комбо", anchor: "Комбо" },
  { id: 10, name: "Контакты", anchor: "Контакты" },
];
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
