<template>
  <div class="footer__media">
    <div class="footer__media-question">
      Остались вопросы? а мы всегда на связи:
    </div>
    <div class="footer__media-cards">
      <div class="footer__media-card" v-for="card in cards">
        <img
          class="footer__media-card-img"
          :src="`img/social/${card.img}.png`"
          :alt="card.img"
        />
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
<style lang="scss">
.footer__media-cards {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  padding-top: 33px;
}
.footer__media-card {
  border: 2px solid hsla(210, 47%, 93%, 1);
  padding: 11px 36px;
  border-radius: 13px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.footer__media-card-last-child {
  grid-column: 3 / 5;
}
</style>
