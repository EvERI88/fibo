<template>
  <p class="title">Корзина</p>
  <div class="basket">
    <div class="basket__wrapper">
      <div class="basket__line"></div>
      <div class="basket__wrapper-product" v-for="item in itemsInBasket">
        <div class="basket__image">
          <img
            :src="
              item.image === 'none'
                ? `http://api.fibo.local/images/products/none.jpg`
                : `http://api.fibo.local/${item.image}`
            "
            :alt="`http://api.fibo.local/images/products/none.jpg`"
          />
        </div>
        <div class="basket__detail">
          <p class="basket__detail-title">{{ item.name }}</p>
          <p class="basket__detail-description">{{ item.description }}</p>
        </div>
        <div class="basket__button">
          <template v-for="basketQuantity in basketStore.basket?.items">
            <div
              v-if="basketQuantity.id === item.id"
              class="basket__button-price-product"
            >
              <p class="basket__button-price">
                {{ item.price * basketQuantity.quantity }} ₽
              </p>
              <div class="basket__button-quantity">
                <div class="basket__top-info-quantity">
                  <i
                    class="fa-solid fa-minus basket__top-info-quantity-minus"
                    @click="minusQuantity(basketQuantity)"
                  ></i>
                  <p>{{ basketQuantity.quantity }}</p>
                  <i
                    @click="plusQuantity(basketQuantity)"
                    class="fa-solid fa-plus basket__top-info-quantity-plus"
                  ></i>
                </div>
              </div>
            </div>
          </template>

          <button
            type="button"
            class="basket__button-remove"
            @click="removeItem(item.id)"
          ></button>
        </div>
      </div>
      <p class="basket__title">Добавить в корзину</p>
    </div>
    <BasketSlider />
    <p class="basket__title basket__title-sous">
      Соусы к бортикам или закускам
    </p>
    <SousBasket />
    <BasketBottom />
  </div>
</template>
<script lang="ts" setup>
import BasketBottom from "./BasketBottom.vue";
import BasketSlider from "./BasketSlider.vue";
import SousBasket from "./SousBasket.vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";
import { onMounted, ref, watchEffect } from "vue";

interface BasketQuantity {
  id: number;
  quantity: number;
}

const basketStore = useBasketStore();
const emptyBasket = ref(false);
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
        if (data.status === "error") {
          emptyBasket.value = true;
        }
        data.products
          ? (itemsInBasket.value = data.products)
          : (data.products = []);
        console.log(itemsInBasket.value);
      });
  } catch (err) {
    console.log(err);
  }
};

const minusQuantity = <T extends BasketQuantity>(basketQuantity: T) => {
  if (basketQuantity.quantity > 1) {
    basketQuantity.quantity = --basketQuantity.quantity;
    basketStore.basket.items.map((x) =>
      x.id === basketQuantity.id ? (x = basketQuantity) : ""
    );
    localStorage.setItem("basket", JSON.stringify(basketStore.basket));
  }
};
const plusQuantity = <T extends BasketQuantity>(basketQuantity: T) => {
  basketQuantity.quantity = ++basketQuantity.quantity;
  basketStore.basket.items.map((x) =>
    x.id === basketQuantity.id ? (x = basketQuantity) : ""
  );
  localStorage.setItem("basket", JSON.stringify(basketStore.basket));
};

const removeItem = <T extends number | string>(id: T): void => {
  const deletedItem = basketStore.basket?.items.findIndex((x) => x.id == id);
  basketStore.removeToBasket(deletedItem);
  localStorage.setItem("basket", JSON.stringify(basketStore.basket));
  itemsInBasket.value.splice(
    itemsInBasket.value.findIndex((x: { id: number }) => x.id === id),
    1
  );
  if (itemsInBasket.value.length < 1) {
    emptyBasket.value = true;
  }
};

const allPrice = () => {
  if (!itemsInBasket.value) {
    console.error("itemsInBasket.value не определено");
    return 0;
  }

  const totalPrice = basketStore.basket.items.reduce((total, item) => {
    const foundItem = itemsInBasket.value.find(
      (x: { id: number }) => x.id === item.id
    );

    if (foundItem) {
      return total + (foundItem.price || 0) * (item.quantity || 0);
    }

    return total;
  }, 0);
  basketStore.basket.allPrice = totalPrice;
};

watchEffect(allPrice);

onMounted(() => {
  getProduct();
});
</script>
<style lang="scss" scoped>
.title {
  max-width: 800px;
  text-align: left;
  margin: 0 auto;
  width: 100%;
  font-family: Montserrat;
  font-weight: 800;
  font-size: 36px;
  line-height: 100%;
  color: var(--col-title);
}
.basket {
  display: flex;
  justify-content: center;
  flex-direction: column;
  &__title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 24px;
    line-height: 17px;
    text-align: left;
    width: 100%;
    padding-bottom: 32px;
    padding-top: 32px;
  }
  &__title-sous {
    padding-top: 40px;
    max-width: 800px;
    margin: 0 auto;
  }
  &__wrapper {
    max-width: 800px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: column;
    margin: 0 auto;
  }
  &__wrapper-product {
    display: grid;
    grid-template-columns: 96px 350px 1fr 1fr;
    justify-content: start;
    gap: 25px;
    width: 100%;
    align-items: center;
    position: relative;
    padding: 18px 0;
  }
  .basket__wrapper-product::before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);
    height: 1px;
    width: 100%;
    background: rgba(236, 236, 241, 1);
  }
  &__image {
    max-width: 71px;
  }
  &__detail {
    max-width: 410px;
  }
  &__button {
    display: flex;
    flex-direction: row;
  }
  &__button-quantity {
    display: flex;
    flex-direction: row;
  }
  &__button-price-product {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0;
    min-width: 250px;
  }
  .fa-solid {
    font-weight: 800;
    font-size: 11px;
    line-height: 17px;
  }
  &__top-info-quantity {
    display: flex;
    text-align: center;
    justify-content: space-around;
    align-items: center;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 18px;
    line-height: 28px;
    color: rgba(105, 111, 122, 1);
    background-color: rgba(243, 243, 247, 1);
    max-width: 93px;
    border-radius: 8px;
    justify-content: center;
    gap: 20px;
    height: 32px;
    padding-right: 17px;
    padding-left: 17px;
    width: 93px;
  }
  &__button-remove {
    content: "";
    width: 27px;
    height: 27px;
    background-image: url("img/basket/closeButton.png");
    position: absolute;
    right: 10px;
    transform: translate(13px, -50%);
    top: 50%;
  }
  &__line {
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);
    height: 1px;
    width: 100%;
    background: rgba(236, 236, 241, 1);
    margin-top: 18px;
  }
  &__detail-title {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 19px;
    line-height: 17px;
    color: rgba(14, 12, 13, 1);
  }
  &__detail-description {
    font-family: Montserrat;
    font-weight: 500;
    font-size: 13px;
    line-height: 19px;
    color: rgba(104, 100, 102, 1);
    padding-top: 9px;
  }
  &__button-price {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 24px;
    line-height: 100%;
    text-align: center;
    white-space: nowrap;
  }
}
</style>
