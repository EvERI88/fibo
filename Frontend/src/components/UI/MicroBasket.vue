<template>
  <div class="micro-basket">
    <div
      v-for="item in itemsInBasket"
      class="micro-basket__wrapper"
      :key="item.id"
    >
      <div class="micro-basket__top">
        <div class="micro-basket__top-img">
          <img
            :src="
              item.image === 'none'
                ? `http://api.fibo.local/images/products/none.jpg`
                : `http://api.fibo.local/${item.image}`
            "
            alt="item.image"
          />
        </div>
        <div class="micro-basket__top-info">
          <p>{{ item.name }}</p>
          <div class="micro-basket__top-info-quantity">
            <i class="fa-solid fa-minus"></i>
            <template v-for="basketQuantity in basketStore.basket?.items">
              <p v-if="basketQuantity.id === item.id">
                {{ basketQuantity.quantity }}
              </p>
            </template>
            <i class="fa-solid fa-plus"></i>
          </div>
        </div>
        <div class="micro-basket__top-func">
          <button
            class="micro-basket__top-func-remove-item"
            type="button"
            @click="removeItem(item.id)"
          ></button>
          <p>{{ item.price }} $</p>
        </div>
      </div>
      <div class="micro-basket__line"></div>
    </div>
    <div class="micro-basket__bottom">
      Сумма заказа <span class="micro-basket__bottom-price">{{ 0 }}</span>
      <p class="micro-basket__bottom-question">Добавить к заказу?</p>
      {{ "slider" }}
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from "vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";

const basketStore = useBasketStore();
const baseUrl: string = "http://api.fibo.local/";
const itemsInBasket = ref();

const getProduct = async () => {
  const idProducts: number[] = basketStore.basket.items.reduce<number[]>(
    (array, item) => {
      array.push(item.id);
      return array;
    },
    []
  );
  try {
    await fetch(`${baseUrl}common/basket`, {
      method: "POST",
      body: JSON.stringify({ products: idProducts }),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        console.log(basketStore.getTotalItems);

        data.products
          ? (itemsInBasket.value = data.products)
          : (data.products = []);
      });
  } catch (err) {
    console.log(err);
  }
};

const removeItem = <T extends number | string>(id: T): void => {
  const deletedItem = basketStore.basket?.items.findIndex((x) => x.id == id);

  basketStore.removeToBasket(deletedItem);
  localStorage.setItem("basket", JSON.stringify(basketStore.basket));
  console.log(itemsInBasket.value);

  itemsInBasket.value.splice(
    itemsInBasket.value.findIndex((x: any) => x.id === id),
    1
  );
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
  border-radius: 10px;
  padding: 24px;
  &__line {
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);
    height: 1px;
    width: 100%;
    background: rgba(236, 236, 241, 1);
    margin: 18px 0;
  }
  &__wrapper {
    position: relative;
  }
  &__top {
    display: grid;
    grid-template-columns: 71px 146px 1fr;
  }
  &__top-info {
    padding-left: 17px;
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
  &__top-func {
    display: flex;
    flex-direction: column;
    align-items: end;
    justify-content: end;
    padding-bottom: 10px;
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 20px;
    line-height: 100%;
    text-align: center;
  }
  &__top-func-remove-item {
    content: "";
    width: 27px;
    height: 27px;
    background-image: url("img/basket/closeButton.png");
    position: absolute;
    right: 0;
    top: 0;
  }
}
</style>
