<template>
  <div class="contacts">
    <div class="contacts__wrapper">
      <img
        class="contacts__wrapper-image-map"
        src="/img/contacts/maps.png"
        alt=""
      />
      <div class="contacts__wrapper-info">
        <a href="tel:+78003333662" class="contacts__wrapper-info-phone"
          >8 800 333-36-62</a
        >
        <div class="contacts__wrapper-info-address">
          ул. Проспект Вернадского 86В
          <span class="contacts__wrapper-info-address-delivery"
            >Доставка и самовывоз 10:00 — 23:00</span
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts"></script>
<style scoped lang="scss">
.contacts {
  &__wrapper {
    max-width: 1100px;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin: 0 auto;
  }
  &__wrapper-image-map {
    width: 100%;
    border-radius: 14px;
  }
  &__title {
  }
  &__wrapper-info {
    padding-top: 43px;
  }
  &__wrapper-info-phone {
    color: var(--col-yellow);
    font-weight: 700;
    font-size: 38px;
    line-height: 46.32px;
  }
  &__wrapper-info-address {
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-weight: 700;
    font-size: 26px;
    line-height: 31.69px;
  }
  &__wrapper-info-address-delivery {
    font-size: 15px;
  }
}
.contacts::before {
  position: absolute;
  content: "";
  right: 0;
  top: 15%;
  height: 365px;
  width: 196px;
  background-image: url("/img/contacts/women.png");
  background-repeat: no-repeat;
}
</style>
