<template>
  <span class="col-yellow menu-main-title">Паста</span>
  <div class="menu-main">
    <div class="menu-main__list">
      <div class="menu-main__list-item" v-for="piz in pizza">
        <img :src="`/img/pizza/${piz.img}.png`" alt="piz.img" />
        <div :class="{ newPush: piz.new }" />
        <p class="menu-main__list-item-title">{{ piz.title }}</p>
        <p class="menu-main__list-item-description">
          {{ piz.description }}
        </p>
        <div class="menu-main__list-item-price">
          от {{ piz.price }} ₽
          <button class="menu-main__list-item-buy">В корзину</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
defineProps({
  pizza: {
    type: Object,
  },
});
</script>
