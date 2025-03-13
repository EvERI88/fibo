<template>
  <h2 class="main-new-title">Новинки</h2>

  <div class="main-new">
    <div class="main-new__wrapper">
      <div
        class="main-new__new-product"
        v-for="product in newProducts"
        :key="product.id"
      >
        <div class="main-new__new-product-img">
          <img
            :src="`http://api.fibo.local/images/products/newPizza.png`"
            :alt="`http://api.fibo.local/images/products/newPizza.jpg`"
          />
        </div>
        <div class="main-new__new-product-info">
          {{ product.name }}
          <div class="main-new__new-product-info-price">
            от {{ product.price }} ₽
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
interface NewProducts {
  id: number;
  name: string;
  image: string;
  price: number;
}

defineProps<{
  newProducts: NewProducts[];
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
