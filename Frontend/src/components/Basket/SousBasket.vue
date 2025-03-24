<template>
  <div class="sous-basket">
    <div
      class="sous-basket__wrapper"
      v-for="(card, index) in allSous.sous"
      :key="index"
      :class="{ 'sous-basket__wrapper-selected': setSelected(index) }"
    >
      <div class="sous-basket__cart">
        <img
          class="sous-basket__cart-img"
          :src="`/img/pizza/SGUSHENKA.png`"
          :alt="`http://api.fibo.local/images/products/SGUSHENKA.png`"
        />
        <div class="sous-basket__cart-title">{{ card.name }}</div>
        <div class="sous-basket__cart-price">от {{ card.price }} Р</div>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
// import { useBasketStore } from "../../../stores/useBasketStore.ts";

interface Sous {
  sous: {
    id: number;
    name: string;
    price: number;
  }[];
}

// const basketStore = useBasketStore();
const allSous = <Sous>{
  sous: [
    { id: 1, name: "Кетчуп", price: 1 },
    { id: 2, name: "Кетчуп", price: 10 },
    { id: 3, name: "Кетчуп", price: 100 },
    { id: 4, name: "Кетчуп", price: 100 },
    { id: 5, name: "Кетчуп", price: 100 },
    { id: 6, name: "Кетчуп", price: 100 },
  ],
};

const selectedSous = ref<Sous>({
  sous: [],
});

// const selectSous = (card: any) => {
//   selectedSous.value.sous.push(card);
//   totalPrice(card.price);
// };
// const totalPrice = (price: number) => {
//   const sousPrice = selectedSous.value.sous.reduce(
//     (totalPriceSous, item) => totalPriceSous + item.price,
//     0
//   );
//   basketStore.basket.allPrice += price;
// };

const setSelected = (index: number) => {
  const searchIndex = index + 1;
  const isSelected = selectedSous.value.sous.find((x) => x.id === searchIndex);
  if (isSelected) {
    return true;
  } else {
    return false;
  }
};
</script>
<style lang="scss">
.sous-basket {
  display: flex;
  flex-direction: row;
  gap: 21px;
  margin: 0 auto;
  max-width: 800px;

  &__wrapper {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 12px;
    max-width: 115px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
  &__wrapper-selected {
    border: 2.5px solid rgba(247, 210, 45, 0.4);
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
