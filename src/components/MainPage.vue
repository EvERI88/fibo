<template>
  <main>
    <Slider :sliderImg="sliderImg" />
    <MainNew />
    <span class="col-yellow menu-main-title">Паста</span>
    <div class="menu-main">
      <div class="menu-main__list">
        <div class="menu-main__list-item" v-for="piz in pizza">
          <img :src="`/img/pizza/${piz.img}.png`" alt="piz.img" />
          <p class="menu-main__list-item-title">{{ piz.title }}</p>
          <p class="menu-main__list-item-description">
            {{ piz.description }}
          </p>
          <div class="menu-main__list-item-price">
            от {{ piz.price }} ₽
            <button class="menu-main__list-item-buy">В корзину</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup>
import MainNew from "./Main/MainNew.vue";
import Slider from "./UI/Slider.vue";

const sliderImg = [
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];
const pizza = [
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 1,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 1,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 1,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 1,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 0,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
  {
    img: "pizza1",
    new: 1,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: "600",
  },
];
</script>

<style lang="scss">
.read-the-docs {
  color: #888;
}
.embla {
  position: relative;
  overflow: hidden;
}
.embla__viewport {
}
.embla__container {
  display: flex;
  gap: 30px;
}
.embla__slide {
  flex: 0 0 50%;

  min-width: 0;
}
.embla_slide-img {
  height: 100%;
  object-fit: cover;
  object-position: left;
}

.embla__btn {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
}

.main-new {
  display: flex;
  justify-content: space-between;
  gap: 30px;
  padding-bottom: 46px;
  &__new-product {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    align-items: center;
    box-shadow: 0px 4px 24px 0px #0000000f;
    padding: 14px 35px 14px 17px;
    border-radius: 12px;
  }
  &__new-product-info {
    display: flex;
    flex-direction: column;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 18px;
    line-height: 21.94px;
  }
}
.main-new-title {
  font-weight: 700;
  font-size: 24px;
  line-height: 29.26px;
  padding-top: 71px;
  padding-bottom: 33px;
}
.menu-main-title {
  font-family: Montserrat;
  font-weight: 800;
  font-size: 32px;
  line-height: 39.01px;
}
.menu-main {
  &__list {
    padding-top: 26px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 25px;
  }
  &__list-item {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }
  &__list-item-title {
    font-weight: 800;
    font-size: 24px;
    line-height: 28px;
    color: #797979;
  }
  &__list-item-description {
    font-weight: 500;
    font-size: 13px;
    line-height: 19px;
    color: #686466;
    padding-top: 14px;
  }
  &__list-item-price {
    display: flex;
    justify-content: space-between;
    padding-top: 25px;
    align-items: center;
  }
  &__list-item-buy {
    background: #f7d22d;
    border-radius: 8px;
    font-size: 14px;
    line-height: 28px;
    color: #fff;
    padding: 4px 23px;
    font-weight: 700;
  }
  &__list-item-buy:hover {
    color: #000;
  }
}
</style>
