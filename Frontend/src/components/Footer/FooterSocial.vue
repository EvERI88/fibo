<template>
  <div class="footer__social">
    <Logo />
    <div class="social__button">
      <a class="social__button--black" href="#">Калорийность и состав</a
      ><a href="#" class="social__button--black">Правовая информация</a
      ><a class="social__button--black" href="#">Мы в соцсетях</a>
    </div>
    <ul class="social__list">
      <li class="list__item">
        <a class="social__button--black" href="https://youtube.com/">YouTube</a>
      </li>
      <li class="list__item">
        <a class="social__button--black" href="https://facebook.com/"
          >Facebook</a
        >
      </li>
      <li class="list__item list__item-street">Москва ул. Проспект</li>
      <li class="list__item">
        <a class="social__button--black" href="https://instagram.com/"
          >Instagram</a
        >
      </li>
      <li class="list__item">
        <a class="social__button--black" href="https://vk.com/">ВКонтакте</a>
      </li>
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
</template>
<script setup lang="ts">
import Logo from "../UI/Logo.vue";
</script>

<style lang="scss" scoped>
.footer__social {
  max-width: 1110px;
  display: flex;
  padding: 50px 0;
  justify-content: left;
  flex-direction: column;
  padding: 50px 0;
}
.social {
  &__button {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    padding-top: 33px;
  }

  &__button--black {
    color: var(--col-black);
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
</style>
