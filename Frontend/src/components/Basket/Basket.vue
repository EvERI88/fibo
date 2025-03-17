<template>
  <p class="title">Корзина</p>
  <div class="basket">
    <div class="basket__wrapper">
      <div class="basket__line"></div>
      <div class="basket__wrapper-product">
        <div class="basket__image">
          <img
            :src="`http://api.fibo.local/images/products/newPizza.png`"
            :alt="`http://api.fibo.local/images/products/newPizza.jpg`"
          />
        </div>
        <div class="basket__info"></div>
        <div class="basket__detail">
          <p class="basket__detail-title">С креветками и трюфелями</p>
          <p class="basket__detail-description">
            Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное
            масло, черный перец, пармезан.350 г
          </p>
        </div>
        <div class="basket__button">
          <p class="basket__button-price">12200</p>
          <div class="basket__button-quantity">
            <div class="basket__top-info-quantity">
              <i class="fa-solid fa-minus basket__top-info-quantity-minus"></i>
              <p>1</p>
              <i class="fa-solid fa-plus basket__top-info-quantity-plus"></i>
            </div>
          </div>
          <button type="button" class="basket__button-remove"></button>
        </div>
      </div>
      <div class="basket__line"></div>
      <p class="basket__title">Добавить в корзину</p>
      <BasketSlider />
      <p class="basket__title basket__title-sous">
        Соусы к бортикам или закускам
      </p>
      <SousBasket />
      {{ "slider" }}
      <div class="basket__dop-menu">dops dops opds</div>
      <div class="basket-promocode">
        <input type="text" />
        <button type="button"></button>
      </div>
      <div class="basket__total-price"></div>
      <button type="button">Вернуться в магазин</button>
      <button type="button">Оформить заказ</button>
    </div>
  </div>
</template>
<script lang="ts" setup>
import BasketSlider from "./BasketSlider.vue";
import SousBasket from "./SousBasket.vue";
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
  &__title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 24px;
    line-height: 17px;
    text-align: left;
    width: 100%;
    padding-bottom: 32px;
  }
  &__title-sous {
    padding-top: 40px;
  }
  &__wrapper {
    max-width: 800px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-direction: column;
  }
  &__wrapper-product {
    display: flex;
    justify-content: start;
    gap: 25px;
    width: 100%;
    align-items: center;
    position: relative;
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
    right: 0;
    transform: translate(13px, -50%);
    top: 50%;
  }
  &__line {
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.06);
    height: 1px;
    width: 100%;
    background: rgba(236, 236, 241, 1);
    margin: 18px 0;
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
    padding-right: 34px;
  }
}
</style>
