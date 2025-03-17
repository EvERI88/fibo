<template>
  <div class="sous-basket">
    <div class="sous-basket__wrapper" v-for="card in [1, 2, 3, 4, 5, 6]">
      <div class="sous-basket__cart">
        <img
          class="sous-basket__cart-img"
          :src="`/img/pizza/SGUSHENKA.png`"
          :alt="`http://api.fibo.local/images/products/SGUSHENKA.png`"
        />
        <div class="sous-basket__cart-title">Сгущенка</div>
        <div class="sous-basket__cart-price">от 100 Р</div>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup></script>
<style lang="scss">
.sous-basket {
  display: flex;
  flex-direction: row;
  gap: 21px;
  &__wrapper {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 12px;
    max-width: 115px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
  &__cart {
    padding: 14px 25px 22px 25px;
  }
  &__cart-img {
    width: 71px;
    height: 64px;
    border-radius: 92px;
  }
  &__cart-title {
    padding-top: 11px;
    padding-bottom: 10px;
    color: rgba(0, 0, 0, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 14px;
    text-align: center;
  }
  &__cart-price {
    color: rgba(255, 46, 101, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 100%;
    text-align: center;
  }
}
</style>
