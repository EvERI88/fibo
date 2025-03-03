<template>
  <h2 class="main-new-title">Новинки</h2>

  <div class="main-new">
    <div class="main-new__wrapper">
      <div
        class="main-new__new-product"
        v-for="(product, index) in newProducts"
        :key="index"
      >
        <div class="main-new__new-product-img">
          <img :src="`/img/pizza/${product.img}.png`" :alt="product.title" />
        </div>
        <div class="main__new-product-info">
          {{ product.title }}
          <div class="col-yellow">от {{ product.price }} ₽</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
interface NewPizza {
  title: string;
  img: string;
  price: number;
}

defineProps({
  newProducts: {
    type: Array as () => NewPizza[],
  },
});
</script>
