<template>
  <h2 id="pizza" class="col-yellow menu-main-title">Паста</h2>
  <div class="menu-main">
    <div class="menu-main__wrapper">
      <div class="menu-main__list">
        <div class="menu-main__list-item" v-for="piz in pizzaList">
          <img :src="`/img/pizza/${piz.img}.png`" alt="piz.img" />
          <div :class="{ newPush: piz.new }" />
          <h3 class="menu-main__list-item-title">{{ piz.title }}</h3>
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
  </div>
</template>
<script setup lang="ts">
interface PizzaList {
  img: string;
  title: string;
  description: string;
  price: number;
  new: boolean;
}

const props = defineProps({
  pizzaList: {
    type: Array as () => PizzaList[], // Correctly type the prop as an array of PizzaList objects
    required: true, // You may want to add required: true, if the prop is necessary
  },
});
</script>
