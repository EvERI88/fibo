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
    <Feedback class="footer__telephone-contact" />
  </div>
</template>
<script setup lang="ts">
import Feedback from "../UI/Feedback.vue";
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
.footer {
  &__media {
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 50px 0;
  }
  &__media-card-text {
    font-weight: 700;
    font-size: 13px;
    line-height: 15.85px;
  }
  &__media-card-img {
    max-width: 30px;
    width: 100%;
  }
  &__telephone-contact {
    flex-direction: column-reverse;
    align-items: left !important;
    padding-top: 25px;
    font-weight: 700;
    font-size: 13px;
    line-height: 15.85px;
  }
  &__media-question {
    text-transform: uppercase;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 17.07px;
  }
  .feedback {
    &__telephone-btn {
      max-width: 180px;
    }
  }
  &__media-cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    padding-top: 33px;
  }
  &__media-card {
    border: 2px solid hsla(210, 47%, 93%, 1);
    padding: 11px 36px;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  &__media-card-last-child {
    grid-column: 3 / 5;
  }
}
</style>
