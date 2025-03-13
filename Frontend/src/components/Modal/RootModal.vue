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
  &__wrapper {
    max-width: 668px;
    background-color: #fff;
    margin: 0 auto;
    padding: 40px 30px 40px 30px;
    text-align: start;
    position: relative;
    border-radius: 12px;
    margin-top: 200px;
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
</style>
