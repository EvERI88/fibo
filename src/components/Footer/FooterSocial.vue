<template>
  <div class="footer__social">
    <Logo />
    <div class="social__button">
      <a class="col-black" href="#">Калорийность и состав</a
      ><a href="#" class="col-black">Правовая информация</a
      ><a class="col-black" href="#">Мы в соцсетях</a>
    </div>
    <ul class="social__list">
      <li class="list__item">
        <a class="col-black" href="https://youtube.com/">YouTube</a>
      </li>
      <li class="list__item">
        <a class="col-black" href="https://facebook.com/">Facebook</a>
      </li>
      <li class="list__item list__item-street">Москва ул. Проспект</li>
      <li class="list__item">
        <a class="col-black" href="https://instagram.com/">Instagram</a>
      </li>
      <li class="list__item">
        <a class="col-black" href="https://vk.com/">ВКонтакте</a>
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
