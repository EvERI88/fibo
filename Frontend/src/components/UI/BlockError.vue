<template>
  <div class="main">
    <slot name="body"></slot>
  </div>
</template>
<script setup lang="ts"></script>
<style lang="scss" scoped>
.main {
  border-radius: 8px;
  background: rgba(255, 46, 101, 1);
  height: 42px;
  width: 160px;
}
.main::before {
  content: "";
  width: 20px;
  height: 20px;
  background-image: url("img/auth/35.png");
}
</style>
