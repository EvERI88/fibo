<template>
  <header class="header">
    <div class="header__wrapper">
      <RouterLink to="/" class="header__logo">
        <Logo />
      </RouterLink>
      <div class="header__step">
        <div class="header__step-wrapper">
          <div class="header__step-one header__step-item">1</div>
          Корзина
        </div>
        <div class="header__step-wrapper header__step-wrapper-active">
          <div class="header__step-two header__step-item">2</div>
          Оформление заказа
        </div>
        <div class="header__step-wrapper">
          <div class="header__step-three header__step-item">3</div>
          Заказ принят
        </div>
      </div>
    </div>
  </header>
</template>
<script setup lang="ts">
import Logo from "./UI/Logo.vue";
</script>
<style lang="scss" scoped>
.header {
  display: flex;
  justify-content: center;
  padding-top: 1rem;
  box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);
  padding-bottom: 14px;
  &__wrapper {
    max-width: 1110px;
    width: 100%;
    display: flex;
    justify-content: space-between;
  }

  .main-logo {
    min-width: 80px;
    min-height: 60px;
    flex: 0 0 auto;
  }
  &__step {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 435px;
    width: 100%;
    position: relative;
  }
  &__step-one::before {
    position: absolute;
    content: "";
    height: 1px;
    top: 50%;
    border-bottom: 2px dashed rgba(184, 197, 208, 1);
    z-index: -1;
    width: 102px;
    left: 50px;
  }
  &__step-two::before {
    position: absolute;
    content: "";
    height: 1px;
    top: 50%;
    border-bottom: 2px dashed rgba(184, 197, 208, 1);
    z-index: -1;
    width: 102px;
    left: 50px;
  }
  &__step-item {
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 3;
    background-color: #fff;
    color: rgba(247, 210, 45, 1);
    position: relative;
  }
  &__step-two {
    background: rgba(247, 210, 45, 1);
    color: #000;
  }

  &__step-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: Montserrat;
    font-weight: 600;
    font-size: 14px;
    line-height: 28px;
    color: rgba(105, 111, 122, 0.95);
  }
  &__step-wrapper-active {
    color: #000;
  }
  &__step-one {
    border: 2px solid rgba(247, 210, 45, 1);
  }
  &__step-three {
    border: 2px solid rgba(247, 210, 45, 1);
  }
}
</style>
