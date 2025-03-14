<template>
  <div class="error-block">
    <slot name="body"></slot>
  </div>
</template>
<script setup lang="ts"></script>
<style lang="scss">
.error-block::before {
  content: "";
  position: absolute;
  top: -5px;
  width: 10px;
  height: 10px;
  border-radius: 2px;
  transform: rotate(45deg);
  left: 10%;
  background: rgba(255, 46, 101, 1);
}
.error-block {
  border-radius: 8px;
  background: rgba(255, 46, 101, 1);
  min-height: 42px;
  width: 160px;
  position: relative;
  display: flex;
  align-items: center;
  grid-column: 2;
  margin-left: 32px;
  margin-top: 13px;
  max-width: 225px;
  width: 100%;
  flex-wrap: wrap;
  &__text {
    padding-left: 42px;
    color: #fff;
    text-wrap: wrap;
  }
  &__text::before {
    content: "";
    width: 20px;
    height: 20px;
    background-image: url("img/auth/35.png");
    position: absolute;
    left: 0;
    transform: translate(13px, -50%);
    top: 50%;
  }
}
</style>
