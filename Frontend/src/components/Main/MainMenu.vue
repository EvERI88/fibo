<template>
  <div class="menu-main">
    <div class="menu-main__wrapper">
      <div v-for="menus in listMenu" :key="menus.id">
        <h2 id="pizza" class="menu-main-title">{{ menus.name }}</h2>
        <div class="menu-main__list">
          <div
            class="menu-main__list-item"
            v-for="product in menus.products"
            :key="product.id"
          >
            <img
              :src="
                product.image === 'none'
                  ? `http://api.fibo.local/images/products/none.jpg`
                  : `http://api.fibo.local/${product.image}`
              "
              :alt="`http://api.fibo.local/images/products/none.jpg`"
            />
            <div
              :class="{ 'menu-main__list-item-is-new': product.is_new }"
              v-if="product.is_new"
            >
              NEW
            </div>
            <h3 class="menu-main__list-item-title">{{ product.name }}</h3>
            <p class="menu-main__list-item-description">
              {{ product.description }}
            </p>
            <div class="menu-main__list-item-price">
              <div class="menu-main__list-item-price-text">
                от {{ product.price }} ₽
              </div>
              <button class="menu-main__list-item-buy">В корзину</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
interface Product {
  id: number;
  name: string;
  price: number;
  image: string;
  is_new: boolean;
  description: string;
}

interface ListMenu {
  id: number;
  name: string;
  products: Product[];
}

defineProps<{
  listMenu: ListMenu[];
}>();
</script>

<style scoped lang="scss">
.menu-main-title {
  font-family: Montserrat;
  font-weight: 800;
  font-size: 32px;
  line-height: 39.01px;
  max-width: 1100px;
  margin: 0 auto;
  color: var(--col-yellow);
}
.menu-main {
  display: flex;
  justify-content: center;
  &__wrapper {
    display: grid;
    max-width: 1110px;
    width: 100%;
  }
  &__list {
    padding-top: 26px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 25px;
  }
  &__list-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
  }
  &__list-item-title {
    font-weight: 800;
    font-size: 24px;
    line-height: 28px;
    color: #797979;
  }
  &__list-item-description {
    font-weight: 500;
    font-size: 13px;
    line-height: 19px;
    color: #686466;
    padding-top: 14px;
  }
  &__list-item-price {
    display: flex;
    justify-content: space-between;
    padding-top: 25px;
    align-items: center;
    font-size: 22px;
  }
  &__list-item-price-text {
    white-space: nowrap;
  }
  &__list-item-buy {
    background: #f7d22d;
    border-radius: 8px;
    font-size: 14px;
    line-height: 28px;
    color: #fff;
    padding: 4px 23px;
    font-weight: 700;
  }
  &__list-item-buy:hover {
    color: #000;
  }
  &__list-item-is-new {
    width: 50px;
    height: 20px;
    position: absolute;
    right: 40px;
    top: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    background-color: red;
    border-radius: 10px;
    font-size: 14px;
  }
}
</style>
