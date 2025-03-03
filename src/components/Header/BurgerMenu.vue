<template>
  <div class="burger-menu">
    <div class="burger-menu__wrapper">
      <ul class="burger-menu__list">
        <li><a class="burger-menu__list-item" href="#pizza">Пицца</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Паста</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Супы</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Салаты</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Напитки</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Десерты</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Бакалея</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Антипасти</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Акции</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Комбо</a></li>
        <li><a class="burger-menu__list-item" href="#pizza">Контакты</a></li>
      </ul>
      <div class="burger-menu__function">
        <button class="burger-menu__function-signin">Войти</button>
        <div class="burger-menu__function-basket">
          Корзина <span class="burger-menu__count-product-in-basket">1</span>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
.burger-menu {
  display: flex;
  justify-content: center;
  padding-top: 20px;
  padding-bottom: 41px;
  &__wrapper {
    max-width: 1110px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  &__list {
    display: flex;
    gap: 15px;
  }

  &__list-item {
    color: #000;
    font-weight: 600;
    font-size: 15px;
    line-height: 18.29px;
  }

  &__function {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  &__function-signin {
    font-weight: 700;
    font-size: 16px;
    line-height: 28px;
    color: hsla(219, 7%, 45%, 1);
    padding-right: 31px;
  }
  &__function-basket {
    background-color: hsla(49, 93%, 57%, 1);
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    line-height: 28px;
    color: hsla(345, 6%, 13%, 1);
    padding: 7px 25px;
    cursor: pointer;
  }
  &__count-product-in-basket {
    padding-left: 25px;
    position: relative;
  }
  &__count-product-in-basket::after {
    content: "";
    width: 2px;
    height: 23px;
    background-color: hsla(345, 6%, 13%, 1);
    position: absolute;
    left: 7px;
    top: 0;
  }
}
</style>
