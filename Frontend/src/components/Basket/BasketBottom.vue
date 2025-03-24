<template>
  <div class="basket-bottom">
    <div class="basket-bottom__wrapper">
      <p class="basket-bottom__title">Промокод</p>
      <div class="basket-bottom__wrapper-top">
        <div class="basket-bottom__input">
          <input
            type="text"
            placeholder="Введите промокод"
            class="basket-bottom__input-input"
            v-model="promoCode"
            :disabled="findPromo.discount !== 0"
          />
          <button
            class="basket-bottom__submit-code"
            @click="successCode"
            :disabled="findPromo.discount !== 0"
          >
            Применить
          </button>
        </div>
        <div class="basket-bottom__total">
          <p class="basket-bottom__total-text">
            Сума заказа:
            <span class="basket-bottom__total-price"
              >{{ basketStore.basket.allPrice }} ₽</span
            >
          </p>
        </div>
      </div>
      <BlockError v-if="errorMessage === 'empty'">
        <template v-slot:body>
          <p class="error-block__text">Введите промокод</p>
        </template>
      </BlockError>
      <BlockError v-else-if="errorMessage === 'notFound'">
        <template v-slot:body>
          <p class="error-block__text">Несуществующий промокод</p>
        </template>
      </BlockError>
      <BlockError v-else-if="errorMessage === 'validate'">
        <template v-slot:body>
          <p class="error-block__text">Неверный формат</p>
        </template>
      </BlockError>
      <div class="basket-bottom__wrapper-top-success" v-if="findPromo.id !== 3">
        <p>Успешно применили промокод на {{ findPromo.discount }}%</p>
      </div>
    </div>
    <div class="basket-bottom__wrapper-send-button">
      <RouterLink
        @click="reloadPage"
        to="/"
        class="basket-bottom__wrapper-return-button"
        ><i class="fa-solid fa-angle-left"></i> Вернуться назад</RouterLink
      >
      <button
        class="basket-bottom__wrapper-submit-order"
        @click="createDelivery"
        :disabled="basketStore.basket.items.length < 1"
      >
        Оформить заказ <i class="fa-solid fa-chevron-right"></i>
      </button>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";
import BlockError from "../UI/BlockError.vue";

interface Promo {
  id: number;
  code: string;
  status: number;
  discount: number;
}

const emit = defineEmits<{
  createDeliveryEmit: [createDelivery: boolean];
}>();

const basketStore = useBasketStore();
const baseUrl: string = "http://api.fibo.local/";
const promoCode = ref("");
const findPromo = ref<Promo>({
  id: 3,
  code: "",
  status: 0,
  discount: 0,
});
const createDelivery = () => {
  emit("createDeliveryEmit", true);
};

const errorMessage = ref("");

const successPromo = () => {
  if (findPromo.value.id !== 0) {
    const countDiscount =
      (basketStore.basket.allPrice * findPromo.value.discount) / 100;
    basketStore.basket.allPrice = basketStore.basket.allPrice - countDiscount;
  }
};

const successCode = async () => {
  await fetch(`${baseUrl}promo`, {
    method: "POST",
    body: JSON.stringify({ code: promoCode.value }),
    mode: "cors",
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      if (data.error) {
        errorMessage.value = data.error;
        return;
      } else {
        if (data.code[0]) {
          findPromo.value = {
            id: data.code[0].id,
            code: data.code[0].code,
            status: data.code[0].status,
            discount: data.code[0].discount,
          };
          errorMessage.value = "";
          localStorage.setItem("promo", JSON.stringify(findPromo.value));
        }
      }
    });
};

const reloadPage = () => {
  window.location.reload();
};

watchEffect(successPromo);

const removeLocalStorage = () => {
  localStorage.removeItem("promo");
};

onMounted(() => removeLocalStorage());
</script>
<style lang="scss" scoped>
.basket-bottom {
  width: 100%;
  max-width: 800px;
  margin: 0 auto;

  &__wrapper {
    margin: 0 auto;
    padding-bottom: 42px;
  }
  &__wrapper-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  &__title {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 22px;
    line-height: 17px;
    color: rgba(255, 46, 101, 1);
    padding-top: 43px;
    padding-bottom: 27px;
  }
  &__input {
    max-width: 353px;
    width: 100%;
  }
  &__input-input {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 8px 0 0 8px;
    padding: 7px 0 8px 24px;
    color: rgba(104, 100, 102, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 28px;
  }
  &__submit-code {
    background: var(--col-title);
    color: rgba(35, 31, 32, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 13px;
    line-height: 28px;
    border-radius: 0 8px 8px 0;
    height: 100%;
    padding: 8px 27px;
  }
  &__total-text {
    color: rgba(14, 12, 13, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 24px;
    line-height: 17px;
    display: flex;
    align-items: center;
  }
  &__total-price {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 36px;
    line-height: 100%;
    padding-left: 8px;
  }
  &__wrapper-send-button {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  &__wrapper-return-button {
    color: rgba(105, 111, 122, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    .fa-angle-left {
      font-weight: 900;
      font-size: 15px;
      line-height: 28px;
      padding-right: 15px;
    }
  }
  &__wrapper-submit-order {
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
  &__wrapper-top-success {
    border-radius: 8px;
    background: rgb(31, 187, 52);
    min-height: 42px;
    position: relative;
    display: flex;
    align-items: center;
    grid-column: 2;
    margin-top: 13px;
    width: 100%;
    flex-wrap: wrap;
    max-width: 353px;
    margin-left: 0;
    padding-left: 20px;
    color: #fff;
  }
  &__wrapper-top-success::before {
    content: "";
    position: absolute;
    top: -5px;
    width: 10px;
    height: 10px;
    border-radius: 2px;
    transform: rotate(45deg);
    left: 10%;
    background: rgb(31, 187, 52);
  }
  .error-block {
    max-width: 353px;
    margin-left: 0;
  }
}
</style>
