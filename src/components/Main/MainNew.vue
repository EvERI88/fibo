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
        <div class="main-new__new-product-info">
          {{ product.title }}
          <div class="main-new__new-product-info-price">
            от {{ product.price }} ₽
          </div>
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

defineProps<{
  newProducts: NewPizza[];
}>();
</script>
<style scoped lang="scss">
.main-new-title {
  font-weight: 700;
  font-size: 24px;
  line-height: 29.26px;
  padding-top: 71px;
  padding-bottom: 33px;
  max-width: 1100px;
  margin: 0 auto;
}
.main-new {
  display: flex;
  justify-content: center;
  padding-bottom: 46px;
  &__wrapper {
    max-width: 1110px;
    width: 100%;
    justify-content: space-between;
    display: flex;
    gap: 30px;
  }
  &__new-product {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    align-items: center;
    box-shadow: 0px 4px 24px 0px #0000000f;
    padding: 14px 35px 14px 17px;
    border-radius: 12px;
  }
  &__new-product-info {
    display: flex;
    flex-direction: column;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 18px;
    line-height: 21.94px;
  }
  &__new-product-info-price {
    color: var(--col-yellow);
  }
}
</style>
