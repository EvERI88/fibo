<template>
  <footer class="footer">
    <footer class="footer__wrapper">
      <FooterSocial />
      <FooterMedia />
    </footer>
  </footer>
</template>
<script setup lang="ts">
import FooterSocial from "./Footer/FooterSocial.vue";
import FooterMedia from "./Footer/FooterMedia.vue";
</script>
<style lang="scss">
.footer {
  display: flex;
  justify-content: center;
  &__wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 68px;
    position: relative;
    max-width: 1110px;
    width: 100%;
  }
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
  .header__feedback--telephone-btn {
    max-width: 180px;
  }
}
</style>
