<template>
  <div class="loading">
    <div class="loading__wrapper">
      <div class="loading__spinner"></div>
    </div>
  </div>
</template>
<script setup lang="ts"></script>
<style lang="scss">
.loading {
  position: absolute;
  right: 0;
  left: 0;
  bottom: 0;
  background: linear-gradient(
      0deg,
      rgba(33, 49, 52, 0.2),
      rgba(33, 49, 52, 0.2)
    ),
    linear-gradient(0deg, rgba(247, 210, 45, 0.4), rgba(247, 210, 45, 0.4));
  z-index: 3;
  top: 0;
  &__wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  &__spinner {
    width: 48px;
    height: 48px;
    border: 5px solid var(--col-title);
    border-bottom-color: rgba(255, 46, 101, 1);
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
  }

  @keyframes rotation {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
}
</style>
