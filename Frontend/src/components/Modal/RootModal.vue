<template>
  <div class="wrapper modal">
    <div class="modal__wrapper">
      <slot name="header"></slot>
      <slot name="body"></slot>
      <div class="modal__close" @click="closeModal" />
    </div>
  </div>
</template>
<script setup lang="ts">
const emit = defineEmits<{
  close: [open: boolean];
}>();

const closeModal = () => {
  emit("close", true);
};
</script>
<style lang="scss">
.modal {
  position: relative;
  &__wrapper {
    max-width: 668px;
    background-color: #fff;
    margin: 0 auto;
    padding: 40px 30px 40px 30px;
    text-align: start;
    position: relative;
    border-radius: 12px;
    margin-top: 100px;
  }
  &__close::before {
    content: "";
    position: absolute;
    right: 31px;
    top: 29px;
    width: 40px;
    height: 40px;
    background-image: url("img/auth/Close.png");
    cursor: pointer;
  }
}
.modal {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 10;
  background: linear-gradient(
      0deg,
      rgba(33, 49, 52, 0.2),
      rgba(33, 49, 52, 0.2)
    ),
    linear-gradient(0deg, rgba(247, 210, 45, 0.4), rgba(247, 210, 45, 0.4));
  text-align: center;
  white-space: nowrap;
  &__body {
    gap: 30px;
    display: grid;
  }
  &__title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 32px;
    line-height: 17px;
    letter-spacing: 0%;
    padding-bottom: 41px;
  }

  &__row-input {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 28px;
    letter-spacing: 0%;
    color: rgba(104, 100, 102, 1);
    display: grid;
    grid-template-columns: 158px 1fr;
    align-items: center;
  }
  &__row-input-border {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 8px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0%;
    color: rgba(35, 31, 32, 1);
    padding: 10px 19px 10px 19px;
    margin-left: 32px;
    max-width: 225px;
  }
  &__row-input-border-error {
    border: 1.5px solid rgba(255, 46, 101, 1);
  }
  &__row-footer {
    text-wrap: auto;
    display: grid;
    grid-template-columns: 224px 1fr;
    color: rgba(157, 157, 155, 1);
  }
  &__row-footer-button {
    background: rgba(247, 210, 45, 1);
    color: rgba(255, 255, 255, 1);
    border-radius: 8px;
    padding: 14px 59px;
    font-family: Montserrat;
    font-weight: 800;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0%;
    text-decoration: none;
  }
  &__row-footer-policy {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 19px;
    text-decoration: underline;
    text-decoration-style: solid;
    padding-left: 24px;
    max-width: 319px;
  }
}
.modal.open {
  transform: translateX(0);
}
</style>
