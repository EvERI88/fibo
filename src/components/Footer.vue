<template>
  <footer class="footer">
    <div class="footer__social">
      <Logo />
      <div class="social__button">
        <a class="social__color-black" href="#">Калорийность и состав</a
        ><a href="#" class="social__color-black">Правовая информация</a
        ><a class="social__color-black" href="#">Мы в соцсетях</a>
      </div>
      <ul class="social__list">
        <li class="list__item">YouTube</li>
        <li class="list__item">Facebook</li>
        <li class="list__item list__item-street">Москва ул. Проспект</li>
        <li class="list__item">Instagram</li>
        <li class="list__item">ВКонтакте</li>
        <li class="list__item list__item-street">Вернадского 86В</li>
      </ul>
      <div class="social__pay">
        YaBao Все праав защищены © 2021
        <div class="pay__img">
          <img src="/img/pay/visa.png" alt="#" />
          <img src="/img/pay/paypal.png" alt="#" />
          <img src="/img/pay/mastercard.png" alt="#" />
        </div>
      </div>
    </div>
    <div class="footer__social">
      <Logo />
      <div class="social__button">
        <a href="#">Калорийность и состав</a><a href="#">Правовая информация</a
        ><a href="#">Мы в соцсетях</a>
      </div>
    </div>
  </footer>
</template>
<script setup lang="ts">
import Logo from "./UI/Logo.vue";
</script>
<style lang="scss">
.footer {
  bottom: 0;
  right: 0;
  position: absolute;
  left: 0;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 68px;
  .main-logo {
    min-width: 90px;
    min-height: 66px;
    flex: 0 0 auto;
  }
  &__social {
    max-width: 1110px;
    display: flex;
    padding: 50px 0;
    justify-content: left;
    flex-direction: column;
  }
  .social {
    &__button {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 28px;
      padding-top: 33px;
    }
    &__list {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      padding-top: 15px;
    }
    &__pay {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 36px;
      opacity: 0.8;
      font-family: Montserrat;
      font-weight: 600;
      font-size: 14px;
      line-height: 28px;
      letter-spacing: 0%;
    }
    &__color-black {
      color: black;
    }
  }
  .list {
    &__item {
      font-family: Montserrat;
      font-weight: 600;
      font-size: 16px;
      line-height: 28px;
      gap: 10px;
      color: #0e0c0d;
      opacity: 0.7;
    }
    &__item-street {
      font-size: 14px;
    }
  }
  .pay__img {
    display: flex;
    gap: 23px;
  }
}
</style>
