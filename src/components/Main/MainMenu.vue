<template>
  <h2 id="pizza" class="menu-main-title">Паста</h2>
  <div class="menu-main">
    <div class="menu-main__wrapper">
      <div class="menu-main__list">
        <div
          class="menu-main__list-item"
          v-for="(piz, index) in pizzaList"
          :key="index"
        >
          <img :src="`/img/pizza/${piz.img}.png`" alt="piz.img" />
          <div
            :class="{ 'menu-main__list-item-is-new': piz.new }"
            v-if="piz.new"
          >
            NEW
          </div>
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

defineProps<{
  pizzaList: PizzaList[];
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
    display: flex;
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
    justify-content: center;
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
