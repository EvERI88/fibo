<template>
  <div class="order">
    <div class="order__wrapper">
      <div class="order__info-user">
        <p>Заказ на доставку</p>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Имя</p>
          <input type="text" class="order__info-user-input" />
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Номер телефона</p>
          <input type="text" class="order__info-user-input" />
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Адрес доставки</p>
          <textarea type="text" class="order__info-user-textarea" />
        </div>
        <div class="order__info-user-inputs">
          <p class="order__info-user-text">Время доставки</p>
          <input type="text" class="order__info-user-input" />
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
        <div class="order__info-method-pay">
          <div class="order__info-method-pay-title">123</div>
        </div>
      </div>
      <div class="order__info-product">123</div>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from "vue";

const deliveryInfo = ref({});

onMounted(() => {
  deliveryInfo.value = JSON.parse(localStorage.getItem("order") ?? "");
  console.log(deliveryInfo.value);
});
</script>
<style lang="scss">
.order {
  padding-top: 32px;
  display: flex;
  justify-content: center;

  &__wrapper {
    display: grid;
    grid-template-columns: 730px 337px;
  }
  &__info-product {
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    height: 506px;
    width: 337px;
  }
}
</style>
