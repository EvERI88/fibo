<template>
  <div class="micro-basket">
    <div class="micro-basket__wrapper">
      <div class="micro-basket__top">
        <div class="micro-basket__top-img">img</div>
        <div class="micro-basket__top-info">
          <p>С креветками и трюфелями</p>
          <div class="micro-basket__top-info-quantity">
            <i class="fa-solid fa-minus"></i>
            <p>1</p>
            <i class="fa-solid fa-plus"></i>
          </div>
        </div>
        <div class="micro-basket__top-func">close 120 $</div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from "vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";

const basketMicro = ref();
const basketStore = useBasketStore();
const baseUrl: string = "http://api.fibo.local/";

const getProduct = async () => {
  const idProducts: number[] = basketStore.basket.items.reduce<number[]>(
    (array, item) => {
      array.push(item.id);
      return array;
    },
    []
  );
  console.log(idProducts);
  try {
    await fetch(`${baseUrl}common/basket`)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        const products = data.new.products;
        for (let i = 0; i < products.length; i++) {
          const el = products[i];
          basketMicro.value.push(el);
        }
      });
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  getProduct();
});
</script>
<style lang="scss">
.micro-basket {
  position: absolute;
  top: 100%;
  z-index: 1;
  max-width: 349px;
  right: 0;
  width: 100%;
  border: 3.5px solid rgba(247, 210, 45, 0.4);
  box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
  background: rgba(255, 255, 255, 1);
  border-radius: 3.5px;
  padding: 24px;

  &__wrapper {
    position: relative;
  }

  &__wrapper::before {
    position: absolute;
    width: 10px;
    height: 10px;
    content: "";
    background-color: #fff;
    top: -29px;
    right: 30px;
    transform: rotate(45deg);
  }
  &__top {
    display: grid;
    grid-template-columns: 71px 146px 1fr;
  }
  &__top-info-quantity {
    display: flex;
    text-align: center;
    align-items: center;
    gap: 20px;
    font-family: Montserrat;
    font-weight: 600;
    font-size: 18px;
    line-height: 28px;
    color: rgba(105, 111, 122, 1);
    background-color: rgba(243, 243, 247, 1);
    max-width: 93px;
    border-radius: 8px;
    justify-content: center;
    margin-top: 12px;
  }
  .fa-solid {
    font-weight: 800;
    font-size: 11px;
    line-height: 17px;
  }
}
</style>
