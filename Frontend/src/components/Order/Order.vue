<template>
  <div class="order">
    <div class="order__wrapper">
      <div class="order__info-user">
        <p class="order__info-user-title">Заказ на доставку</p>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Имя</p>
          <input
            type="text"
            class="order__info-user-input order__info-user-name"
            v-model="order.user.name"
          />
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Номер телефона</p>
          <input
            type="text"
            class="order__info-user-input"
            v-model="order.user.telephone"
            disabled
          />
          <button class="order__info-user-change">Изменить</button>
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Адрес доставки</p>
          <textarea
            type="text"
            class="order__info-user-textarea"
            v-model="areaInfo"
            disabled
          />
          <button
            class="order__info-user-change-address order__info-user-change"
            @click="returnBackPage()"
          >
            Изменить
          </button>
          <button class="order__info-user-change-method-delivery">
            Выбрать самовывоз
          </button>
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Время доставки</p>
          <input
            type="text"
            class="order__info-user-input"
            v-model="order.delivery.time"
            disabled
          />
          <button class="order__info-user-change" @click="toggleModalTime">
            Изменить
          </button>
        </div>
        <p class="order__info-title-promo">Промокод</p>
        <div class="order__info-promo">
          <input
            type="text"
            placeholder="Введите промокод"
            class="order__info-promo-input"
          />
          <button class="order__submit-code">Применить</button>
        </div>
        <div class="order__info-payment-detail">
          <p class="order__info-payment-detail-title">Способ оплаты</p>

          <div
            class="order__info-payment-detail-card"
            @click="methodPayMentFunction('card')"
          >
            <div
              class="order__info-payment-detail-card-radio"
              :class="{
                'order__info-payment-detail-card-radio-selected':
                  methodPayMent === 'card',
              }"
            ></div>
            <p class="order__info-payment-detail-card-text">Картой на сайте</p>
          </div>
          <div
            class="order__info-payment-detail-cash"
            @click="methodPayMentFunction('cash')"
          >
            <div
              class="order__info-payment-detail-card-radio"
              :class="{
                'order__info-payment-detail-card-radio-selected':
                  methodPayMent === 'cash',
              }"
            ></div>
            <p class="order__info-payment-detail-card-text">Наличными</p>
          </div>
          <div class="order__info-payment-detail-change">
            <p class="order__info-payment-detail-change-text">
              С какой суммы подготовить сдачу?
            </p>
            <div class="order__info-payment-detail-change-input-wrapper">
              <input
                v-model="order.delivery.change_money"
                type="text"
                class="order__info-payment-detail-change-input"
                :disabled="withoutChange"
              />
            </div>
            <div
              class="order__info-payment-detail-change-checkbox-wrapper"
              @click="withoutChangeFunction"
            >
              <div
                class="order__info-payment-detail-change-checkbox"
                :class="{
                  'order__info-payment-detail-change-checkbox-selected':
                    withoutChange,
                }"
              ></div>
              <p class="order__info-payment-detail-change-checkbox-text">
                Без сдачи
              </p>
            </div>
          </div>
        </div>
        <div
          class="order__info-bonus-block"
          @click="selectBonus = !selectBonus"
        >
          <div
            class="order__info-bonus-block-checkbox"
            :class="{ 'order__info-bonus-block-checkbox-select': selectBonus }"
          ></div>
          <p class="order__info-bonus-block-text">
            Сообщать о бонусах, акциях и новых продуктах
          </p>
          <div class="order__info-bonus-icon">i</div>
        </div>
        <div class="order__info-function">
          <RouterLink to="/basket" class="order__wrapper-return-button"
            ><i class="fa-solid fa-angle-left"></i> Вернуться в
            корзину</RouterLink
          >
          <div>
            <button class="order__info-function-right" @click="submitOrder">
              Оформить заказ на {{ basketStore.basket.allPrice }} ₽
            </button>
          </div>
        </div>
      </div>
      <div class="order__info-products">
        <p class="order__info-products-title">Состав заказа</p>
        <div class="order__info-products-list">
          <div
            class="order__info-product"
            v-for="product in order.products.product"
          >
            <div class="order__info-product-title" :key="product.id">
              {{ product.name }}
              <template v-for="basketQuantity in basketStore.basket?.items">
                <div
                  v-if="basketQuantity.id === product.id"
                  class="order__button-price-product"
                >
                  <span class="order__info-product-price"
                    >{{ product.price }} * {{ basketQuantity.quantity }} =
                    {{ product.price * basketQuantity.quantity }}₽</span
                  >
                </div>
              </template>
            </div>
            <div class="order__info-product-description">
              {{ product.description }}
            </div>
          </div>
        </div>
        <div class="order__info-product-total-price">
          Сумма заказа
          <snap class="order__info-product-total-price-total"
            >{{ basketStore.basket.allPrice }} ₽</snap
          >
        </div>
        <div class="order__info-product-delivery">Бесплатная доставка</div>
      </div>
    </div>
    <OrderSelectedTime
      v-if="modalChangeTime"
      @close="toggleModalTime"
      @emitChangeTime="selectedTime"
    />
  </div>
  <Loading v-if="loading" />
</template>
<script setup lang="ts">
import { nextTick, onMounted, ref, watchEffect } from "vue";
import { RouterLink, useRouter } from "vue-router";
import { useBasketStore } from "../../../stores/useBasketStore.ts";
import { useUserStore } from "../../../stores/useUserStore.ts";
import OrderSelectedTime from "./OrderSelectedTime.vue";
import Loading from "../UI/Loading.vue";

const router = useRouter();
interface OrderDetail {
  user: {
    id: number | undefined;
    name: string | undefined;
    telephone: string | undefined;
  };
  delivery: {
    address: string;
    home: string;
    number: string;
    numberPod: string;
    intercom: string;
    floor: string;
    methodPay: string;
    name: string;
    comment: string;
    time: string;
    change_money: number;
  };
  products: {
    product: {
      id: number;
      name: string;
      description: string;
      price: number;
      quantity: number;
    }[];
  };
}

interface ItemsInBasket {
  products: [];
}

interface DeliveryInfo {
  address: string;
  home: string;
  number: string;
  numberPod: string;
  intercom: string;
  floor: string;
  methodPay: string;
  name: string;
  comment: string;
  change_money: number;
}

interface Product {
  id: number;
  name: string;
  description: string;
  price: number;
}

const modalChangeTime = ref(false);
const withoutChange = ref(false);
const selectBonus = ref(false);
const methodPayMent = ref("cash");
const baseUrl: string = "http://api.fibo.local/";
const loading = ref(false);

const basketStore = useBasketStore();
const userStore = useUserStore();
const user = ref<OrderDetail["user"] | undefined>(userStore.user);
const deliveryInfo = ref<DeliveryInfo>();
const order = ref<OrderDetail>({
  user: {
    id: 0,
    name: user.value?.name,
    telephone: "",
  },
  delivery: {
    address: "",
    home: "",
    number: "",
    numberPod: "",
    intercom: "",
    floor: "",
    methodPay: "",
    name: "",
    comment: "",
    time: "",
    change_money: 0,
  },
  products: {
    product: [],
  },
});

const areaInfo = ref("");
const emptyBasket = ref(false);
const itemsInBasket = ref<ItemsInBasket>({
  products: [],
});

const toggleModalTime = () => {
  modalChangeTime.value = !modalChangeTime.value;
  if (modalChangeTime.value) {
    document.body.classList.add("scroll-hidden");
    window.scrollTo(0, 0);
  } else {
    document.body.classList.remove("scroll-hidden");
  }
};

const getUserInfo = () => {
  if (userStore.user) {
    order.value.user = {
      id: user.value?.id,
      name: user.value?.name,
      telephone: user.value?.telephone,
    };
  } else {
    console.error("error user data");
  }
};

const getDeliveryInfo = () => {
  if (deliveryInfo.value) {
    order.value.delivery = {
      address: deliveryInfo.value.address,
      home: deliveryInfo.value.home,
      number: deliveryInfo.value.number,
      numberPod: deliveryInfo.value.numberPod,
      intercom: deliveryInfo.value.intercom,
      floor: deliveryInfo.value.floor,
      methodPay: deliveryInfo.value.methodPay,
      name: deliveryInfo.value.name,
      comment: deliveryInfo.value.comment,
      change_money: deliveryInfo.value.change_money,
      time: "Побыстрее",
    };
  }
};

const getProducts = async () => {
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
        if (data.products) {
          itemsInBasket.value.products = data.products;

          for (let i = 0; i < data.products.length; i++) {
            const element: any = data.products[i];
            order.value.products.product.push({
              id: element.id,
              name: element.name,
              description: element.description,
              price: element.price,
              quantity: basketStore.basket.items[i].quantity,
            });
          }
        } else {
          itemsInBasket.value.products = [];
        }
      });
  } catch (err) {
    console.log(err);
  }
};

const submitOrder = async () => {
  const arrayProd = [];
  loading.value = true;
  for (let i = 0; i < order.value.products.product.length; i++) {
    const element: any = order.value.products.product[i];
    arrayProd.push(
      `id: ${element.id} name: ${element.name} quantity: ${element.quantity}`
    );
  }
  console.log(arrayProd.join(" / "));

  await fetch(`${baseUrl}orders/create`, {
    method: "POST",
    body: JSON.stringify({
      name: order.value.user.name,
      number: Math.floor(Math.random() * (9999 - 1111) + 1111),
      user_id: order.value.user.id,
      address: areaInfo.value,
      products: arrayProd.join(" / "),
      selected_time: order.value.delivery.time,
      price: basketStore.basket.allPrice,
      method_pay: methodPayMent.value,
      report_bonus: selectBonus.value ? 1 : 0,
      without_change: withoutChange.value ? 1 : 0,
      change_money: order.value.delivery.change_money
        ? order.value.delivery.change_money
        : 0,
    }),
  })
    .then((response) => {
      loading.value = false;

      return response.json();
    })
    .then((data) => {
      loading.value = false;
      basketStore.clearBasket;
      localStorage.removeItem("basket");
      router.push({ name: "main" });
      window.location.reload();
      console.log(data);
    });
};

const getTextInTextArea = () => {
  const test = Object.values(order.value.delivery);
  areaInfo.value = `Адрес - ${test[0]}
Дом - ${test[1]}
Номер квартиры - ${test[2]}
Подъезд - ${test[3]}
Наличие домофона - ${test[4]}
Этаж - ${test[5]}
Комментарий - ${test[8]}
  `;
};

const selectedTime = (time: string) => {
  order.value.delivery.time = time;
  toggleModalTime();
};
const returnBackPage = () => {
  router.push({ name: "basket" });
};

const withoutChangeFunction = () => {
  withoutChange.value = !withoutChange.value;
  order.value.delivery.change_money = 0;
};

const methodPayMentFunction = (method: string) => {
  methodPayMent.value = method;
  if (methodPayMent.value === "card") {
    withoutChange.value = true;
  }
};

onMounted(() => {
  deliveryInfo.value = JSON.parse(localStorage.getItem("order") ?? "");
  getProducts();
  getUserInfo();
  getDeliveryInfo();
  getTextInTextArea();
  nextTick(() => {
    console.log(userStore.user?.id);

    if (userStore.user?.id == 0) {
      router.push({ name: "main" });
    }
  });
});
</script>
<style lang="scss">
.order {
  padding-top: 32px;
  display: flex;
  justify-content: center;
  &__info-user-textarea {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 17px;
    line-height: 28px;
    padding: 10px 0 10px 19px;
    border-radius: 7px;
  }
  &__button-price-product {
    width: 100%;
    text-align: end;
  }
  &__wrapper {
    display: grid;
    grid-template-columns: 730px 337px;
  }

  &__info-user-title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 32px;
    line-height: 100%;
    width: 100%;
    padding-bottom: 30px;
  }

  &__info-user-inputs {
    display: grid;
    grid-template-columns: 160px 1fr;
    justify-content: space-between;
    align-items: center;
    position: relative;
    padding: 7px 0;
  }

  &__info-user-text {
    color: rgba(35, 31, 32, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 17px;
    line-height: 28px;
  }

  &__info-user-input {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 17px;
    line-height: 28px;
    padding: 10px 0 10px 19px;
    border-radius: 7px;
    background: rgba(241, 242, 245, 0.6);
  }
  &__info-user-name {
    border: 1.5px solid rgba(226, 226, 233, 1);
    background-color: #fff;
  }
  &__info-user-change {
    position: absolute;
    right: 19px;
    color: rgba(247, 210, 45, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
  }
  &__info-user-change-address {
    top: 19px;
  }
  &__info-user-change-method-delivery {
    position: absolute;
    right: 19px;
    color: rgba(247, 210, 45, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    bottom: 19px;
  }
  &__info-user-textarea {
    min-height: 150px;
    resize: none;
    border-radius: 7px;
    background: rgba(241, 242, 245, 0.6);
    overscroll-behavior: none;
  }

  &__info-title-promo {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 22px;
    line-height: 17px;
    padding-bottom: 27px;
    padding-top: 40px;
  }

  &__info-promo {
    display: flex;
    padding-bottom: 58px;
  }

  &__info-promo-input {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 8px 0 0 8px;
    padding: 8px 63px 8px 23px;
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 28px;
  }

  &__submit-code {
    background: rgba(247, 210, 45, 1);
    border-radius: 0 8px 8px 0;
    padding: 7px 26px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 13px;
    line-height: 28px;
    color: rgba(35, 31, 32, 1);
  }

  &__info-method-pay-title {
    color: rgba(255, 46, 101, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 28px;
    line-height: 17px;
    letter-spacing: 0%;
  }

  &__info-payment-detail {
    background-color: rgba(241, 242, 245, 0.6);
    border-radius: 6px;
    padding: 40px 40px 30px 30px;
  }
  &__info-payment-detail-title {
    color: rgba(255, 46, 101, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 28px;
    line-height: 17px;
    letter-spacing: 0%;
  }
  &__info-payment-detail-card {
    display: flex;
    padding-top: 37px;
    padding-bottom: 22px;
    align-items: center;
  }
  &__info-payment-detail-card-radio {
    content: "";
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid rgba(255, 46, 101, 1);
    position: relative;
  }
  &__info-payment-detail-card-radio-selected::before {
    content: "";
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    left: 50%;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgba(255, 46, 101, 1);
  }
  &__info-payment-detail-card-text {
    color: rgba(33, 49, 52, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 18px;
    line-height: 17px;
    padding-left: 18px;
  }
  &__info-payment-detail-cash {
    display: flex;
    align-items: center;
    padding-bottom: 26px;
  }

  &__info-payment-detail-change {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  &__info-payment-detail-change-text {
    color: rgba(35, 31, 32, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    padding-right: 24px;
  }
  &__info-payment-detail-change-input {
    border: 1.5px solid rgba(226, 226, 233, 1);
    padding: 9px 17px;
    font-family: Montserrat;
    font-weight: 600;
    font-size: 17px;
    line-height: 28px;
    border-radius: 7px;
    width: 100%;
  }
  &__info-payment-detail-change-checkbox-wrapper {
    display: flex;
    gap: 5px;
  }
  &__info-payment-detail-change-checkbox {
    opacity: 1;
  }
  &__info-payment-detail-change-checkbox::before {
    content: "";
    border: 2px solid rgba(255, 46, 101, 1);
    width: 20px;
    height: 20px;
    position: absolute;
    border-radius: 3px;
  }
  &__info-payment-detail-change-checkbox-selected::before {
    font-family: "Font Awesome 5 Free";
    content: "\f00c";
    color: rgba(255, 46, 101, 1);
    width: 20px;
    height: 20px;
    position: absolute;
    border-radius: 3px;
    text-align: center;
  }
  &__info-payment-detail-change-input-wrapper {
    position: relative;
    max-width: 116px;
  }
  &__info-payment-detail-change-input-wrapper::before {
    content: "₽";
    position: absolute;
    right: 17px;
    top: 50%;
    transform: translate(0, -50%);
  }
  &__info-payment-detail-change-input::after {
  }
  &__info-payment-detail-change-checkbox-text {
    padding-left: 21px;
  }
  &__info-bonus-block {
    display: flex;
    position: relative;
    align-items: center;
    padding-top: 38px;
    padding-bottom: 60px;
  }
  &__info-bonus-block-checkbox {
    content: "";
    border: 2px solid rgba(247, 210, 45, 1);
    width: 20px;
    height: 20px;
    position: absolute;
    border-radius: 3px;
  }
  &__info-bonus-block-checkbox-select::before {
    font-family: "Font Awesome 5 Free";
    content: "\f00c";
    color: rgba(247, 210, 45, 1);
    width: 20px;
    height: 20px;
    position: absolute;
    left: 10%;
    border-radius: 3px;
  }
  &__info-bonus-block-text {
    padding-left: 35px;
    padding-right: 23px;
  }
  &__info-bonus-icon {
    background-color: rgba(241, 242, 245, 1);
    border-radius: 50%;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 28px;
    color: rgba(35, 31, 32, 1);
    padding: 1px 11px;
  }

  &__info-function {
    display: flex;
    justify-content: space-between;
  }

  &__info-function-left {
    background-color: #000;
  }
  &__wrapper-return-button {
    display: flex;
    gap: 15px;
    align-items: center;
    color: rgba(105, 111, 122, 1);
  }

  &__info-function-right {
    background: rgba(247, 210, 45, 1);
    border-radius: 8px;
    font-family: Montserrat;
    font-weight: 800;
    font-size: 15px;
    line-height: 28px;
    color: rgba(35, 31, 32, 1);
    padding: 13px 43px;
    position: relative;
    .fa-chevron-right {
      font-weight: 900;
      font-size: 15px;
      line-height: 28px;
      position: absolute;
      right: 21px;
    }
  }
}

.order {
  &__info-products {
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    padding: 22px;
    height: fit-content;
    margin-top: 20px;
    margin-left: 42px;
  }

  &__info-products-title {
    font-family: Montserrat;
    font-weight: 800;
    font-size: 16px;
    line-height: 28px;
    color: var(--col-title);
  }

  &__info-products-list {
  }

  &__info-product {
  }

  &__info-product-title {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 16px;
    line-height: 28px;
    color: rgba(35, 31, 32, 0.8);
    display: flex;
    justify-content: space-between;
  }

  &__info-product-price {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 17px;
    line-height: 28px;
    text-align: right;
    color: rgba(35, 31, 32, 1);
  }

  &__info-product-description {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 11px;
    line-height: 28px;
    color: rgba(35, 31, 32, 0.8);
  }

  &__info-product-total-price {
    display: flex;
    justify-content: space-between;
    color: rgba(35, 31, 32, 0.6);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 16px;
    line-height: 28px;
  }
  &__info-product-total-price-total {
    font-family: Montserrat;
    font-weight: 800;
    font-size: 17px;
    line-height: 28px;
    color: rgba(35, 31, 32, 1);
  }
  &__info-product-delivery {
    text-align: center;
    padding-top: 19px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    opacity: 0.6;
  }
}
</style>
