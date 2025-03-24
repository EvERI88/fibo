<template>
  <div class="orders" v-if="orders.orders.length > 0">
    <PersonalOrdersPaginate
      @prevPage="currentList--"
      @nextPage="currentList++"
      @changeCurrentList="changeNumberList"
      :currentList
      :totalPage
      :listNumber
    />
    <div class="orders__wrapper">
      <div class="orders__items">
        <div
          class="orders__items-item"
          v-for="(item, index) in orders.orders"
          :key="item.id"
        >
          <div class="orders__items-item-title">
            Номер заказа:
            <span class="orders__items-item-title-span">{{ item.number }}</span>
            Цена заказа:
            <span class="orders__items-item-title-span">{{ item.price }}₽</span>
          </div>

          <div class="orders__method_pay">
            Способ оплаты:
            <span class="orders__method_pay-span">
              {{
                item.method_pay === "cash"
                  ? "Наличный расчет"
                  : "Безналичный расчет"
              }}
            </span>
          </div>
          <div
            class="orders__items-item-accordion"
            @click="item.visibleProduct = !item.visibleProduct"
          >
            {{ updateProducts(index).countSymbol }}
            Показать продукты
            <i class="fa-solid fa-arrows-up-down"></i>
            <div
              v-if="item.visibleProduct"
              class="orders__items-item-accordion-products"
              @click.stop
            >
              <textarea
                disabled
                name=""
                id=""
                class="orders__items-item-accordion-products-text-area"
                :style="{ height: updateProducts(item.id).countSymbol + 'px' }"
              >
 {{ updateProducts(item.id).test }}</textarea
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="not-orders" v-else>
    <div class="not-orders__wrapper">Вы ничего не заказывали</div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import { useUserStore } from "../../../stores/useUserStore.ts";
import PersonalOrdersPaginate from "./PersonalOrdersPaginate.vue";

interface Orders {
  orders: {
    id: number;
    number: number;
    products: string;
    price: string;
    method_pay: string;
    is_active: number;
    visibleProduct: boolean;
    countRow: number;
  }[];
}
interface List {
  number: number[];
}

const currentList = ref(1);
const totalPage = ref(0);
const userStore = useUserStore();
const baseUrl: string = "http://api.fibo.local/";
const orders = ref<Orders>({
  orders: [],
});

const listNumber = ref<List>({
  number: [],
});

const getArrayPage = () => {
  for (let i = 1; i < totalPage.value + 1; i++) {
    listNumber.value.number.push(i);
  }
};

const getOrders = async () => {
  try {
    await fetch(`${baseUrl}orders?page=${currentList.value}`, {
      method: "POST",
      body: JSON.stringify({ id: userStore.user?.id }),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        orders.value.orders = data.orders.items;
        const limit = data.orders.limit;
        const totalItem = data.orders["total_items"];
        totalPage.value = Math.ceil(totalItem / limit);
        if (listNumber.value.number.length < 1) {
          getArrayPage();
        }
      });
  } catch (err) {}
};

const updateProducts = (id: number) => {
  const findPrice = orders.value.orders.find((x) => x.id === id);
  let countSymbol = findPrice?.products.match(/id: \d/g)?.length;

  if (countSymbol) {
    countSymbol = countSymbol * 30;
  }

  const test = findPrice?.products
    .replace(/id: \d\d/g, "")
    .replace(/id: \d/g, "")
    .replace(/id: \d\d\d/g, "")
    .replace(/id: \d\d\d\d/g, "")
    .replace(/name: /g, "")
    .replace(/quantity/g, "количество")
    .replace(/\//gi, "\n");

  return { test: test, countSymbol: countSymbol };
};

const changeNumberList = (number: number) => {
  currentList.value = number;
};

watchEffect(getOrders);

onMounted(() => {
  getOrders();
});
</script>
<style lang="scss">
.orders {
  position: relative;
  max-width: 1100px;
  margin: 0 auto;
  width: 100%;
  &__wrapper {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding-top: 35px;
  }

  &__items {
    padding: 10px 0;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  &__items-item {
    display: flex;
    flex-direction: column;
    gap: 30px;
    border: 1.5px solid rgba(226, 226, 233, 1);
    padding: 10px 20px;
    border-radius: 8px;
  }
  &__items-item-title {
    font-size: 20px;
  }
  &__items-item-title-span {
    color: var(--col-title);
  }
  &__items-item-accordion {
    cursor: pointer;
  }
  &__method_pay {
    font-weight: 500;
  }
  &__method_pay-span {
    font-weight: 800;
    padding-left: 10px;
    color: var(--col-title);
  }
  &__items-item-accordion {
    width: 100%;
  }
  &__items-item-accordion-products {
    padding-top: 10px;
  }
  &__items-item-accordion-products-text-area {
    max-width: 1100px;
    resize: none;
    font-weight: 500;
    line-height: 26px;
  }
}
.not-orders {
  max-width: 1100px;
  width: 100%;
  margin: 0 auto;
  &__wrapper {
    height: 45vh;
  }
}
</style>
