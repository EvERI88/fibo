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
  
  
 
 
  
}
</style>
