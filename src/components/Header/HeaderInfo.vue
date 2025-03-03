<template>
  <div class="header__info">
    <div class="header__info--city">
      Доставка пасты <span class="header__col-yellow">Москва</span>
    </div>
    <div class="header__info-time-stars">
      <img class="header__info-time-stars-ya" src="/img/ya.png" alt="" />

      <div class="header__info-time-stars-circle">Яндекс еда</div>
      <span class="header__time-stars-star"
        >4.8 <i class="fa-solid header__time-stars-star-fa fa-star"></i>
      </span>
      <div class="header__time-stars--time header__info-time-stars-circle">
        Время доставки<span> </span>
      </div>
      <div class="header__time-stars--time-minutes">от 31 мин</div>
    </div>
  </div>
</template>
<style scoped lang="scss">
.header {
  &__info {
    display: flex;
    flex-direction: column;
    flex: 1 1 auto;
    padding: 0 2%;
    min-width: 200px;
  }
  &__info--city {
    font-size: 1.2rem;
    padding-bottom: 0.5rem;
  }

  &__info-time-stars {
    display: flex;
    flex-direction: row;
    gap: 7px;
    font-size: 13px;
    align-items: center;
  }
  &__info-time-stars-ya {
    max-width: 18px;
  }
  &__info-time-stars-circle {
    position: relative;
  }
  &__info-time-stars-circle::before {
    position: absolute;
    content: "";
    width: 4px;
    height: 4px;
    background-color: #ff2e65;
    border-radius: 50%;
    right: -12px;
    top: 50%;
  }
  &__time-stars-star {
    padding-left: 12px;
  }
  &__time-stars-star-fa {
    color: var(--fa-yellow);
  }

  &__time-stars--time {
    padding-left: 7px;
  }
  &__time-stars--time-minutes {
    padding-left: 12px;
  }
}
</style>
