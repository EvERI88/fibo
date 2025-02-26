<template>
  <div class="footer__media">
    <div class="footer__media-question">
      Остались вопросы? а мы всегда на связи:
    </div>
    <div class="footer__media-cards">
      <div class="footer__media-card" v-for="card in cards">
        <img class="footer__media-card-img" :src="`img/social/${card.img}.png`" :alt="card.img" />
      </div>
      <div class="footer__media-card footer__media-card-last-child">
        <p class="footer__media-card-text">Написать нам</p>
      </div>
    </div>
    <HeaderFeedback class="footer__telephone-contact" />
  </div>
</template>
<script setup>
import HeaderFeedback from "../Header/HeaderFeedback.vue";
const cards = [
  { img: "facebook" },
  { img: "hz" },
  { img: "skype" },
  { img: "telegram" },
  { img: "viber" },
  { img: "vk" },
];
</script>
