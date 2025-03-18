<template>
  <div class="micro-basket">
    <div class="micro-basket__empty" v-if="emptyBasket">Корзина пуста</div>
    <div
      v-else
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
          <template v-for="basketQuantity in basketStore.basket?.items">
            <div
              v-if="basketQuantity.id === item.id"
              class="micro-basket__top-info-quantity"
            >
              <i
                class="fa-solid fa-minus micro-basket__top-info-quantity-minus"
                @click="minusQuantity(basketQuantity)"
              ></i>
              <p>
                {{ basketQuantity.quantity }}
              </p>
              <i
                @click="plusQuantity(basketQuantity)"
                class="fa-solid fa-plus micro-basket__top-info-quantity-plus"
              ></i>
            </div>
          </template>
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
    <AddToBasket
      @updateList="getProduct"
      :finalPrice="basketStore.basket.allPrice"
      :sliderImg="sliderImg"
    />
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";
import AddToBasket from "../UI/AddToBasket.vue";

interface BasketQuantity {
  id: number;
  quantity: number;
}
interface SliderImg {
  img: string;
}
const sliderImg: SliderImg[] = [
  { img: "1" },
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];

const basketStore = useBasketStore();
const baseUrl: string = "http://api.fibo.local/";
const itemsInBasket = ref();
const emptyBasket = ref(false);
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
      });
  } catch (err) {
    console.log(err);
  }
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

const allPrice = () => {
  if (!itemsInBasket.value) {
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
watchEffect(getProduct);
watchEffect(allPrice);

onMounted(() => {
  getProduct();
  allPrice();
});
</script>
<style lang="scss" scoped>
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
  max-height: 463px;
  overflow: auto;
  overscroll-behavior: none;
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
    display: flex;
    flex-direction: column;
    justify-content: center;
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
  &__top-info-quantity-plus {
    cursor: pointer;
  }
  &__top-info-quantity-minus {
    cursor: pointer;
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
