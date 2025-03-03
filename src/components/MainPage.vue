<template>
  <main>
    <Slider :sliderImg="sliderImg" />
    <MainNew :newProducts="newProducts" />
    <MainMenu :pizzaList="pizzaList" />
  </main>
</template>
<script setup lang="ts">
import MainMenu from "./Main/MainMenu.vue";
import MainNew from "./Main/MainNew.vue";
import Slider from "./UI/Slider.vue";

interface SliderImg {
  img: string;
}

interface NewProduct {
  title: string;
  img: string;
  price: number;
}

interface menuProduct {
  img: string;
  new: boolean;
  title: string;
  description: string;
  price: number;
}

const newProducts: NewProduct[] = [
  { title: "Карбонара", img: "newPizza", price: 120 },
  { title: "Карбонара", img: "newPizza", price: 120 },
  { title: "Карбонара", img: "newPizza", price: 120 },
  { title: "Карбонара", img: "newPizza", price: 120 },
];

const sliderImg: SliderImg[] = [
  { img: "1" },
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];
const pizzaList: menuProduct[] = [
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: true,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: true,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: true,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: true,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: false,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
  {
    img: "pizza1",
    new: true,
    title: "С креветками и трюфелями",
    description:
      "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
    price: 600,
  },
];
</script>

<style lang="scss">
.newPush {
  width: 50px;
  height: 20px;
  position: absolute;
  right: 40px;
  top: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  background-color: red;
  border-radius: 10px;
  font-size: 14px;
}
.embla {
  position: relative;
  overflow: hidden;
  width: 100%;
  &__container {
    display: flex;
    gap: 15px;
  }
  &__viewport {
    width: 1100px;
    margin: 0 auto;
  }
  &__slide {
    flex: 0 0 calc(50% - 5px);
    min-width: 0;
  }
  &_slide-img {
    height: 100%;
    object-fit: cover;
    object-position: left;
    border-radius: 15px;
  }
  &__btn {
    position: absolute;
    top: 150px;
    left: 123px;
    display: flex;
    justify-content: space-between;
    right: 123px;
  }
  &__slide {
    transform: scale(0.9);
    transition: 1000ms;
    opacity: 0.6;
  }
  &__selected {
    opacity: 1;
    transform: scale(1);
    transition: 1000ms;
  }
}
main::after {
  background-image: url("/img/background-male/body-male.png");
  content: "";
  position: absolute;
  left: 0;
  height: 402px;
  width: 100%;
  background-repeat: no-repeat;
  top: 20%;
  z-index: 0;
}
.main-new {
  display: flex;
  justify-content: center;
  padding-bottom: 46px;
  &__wrapper {
    max-width: 1110px;
    width: 100%;
    justify-content: space-between;
    display: flex;
    gap: 30px;
  }
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
  max-width: 1100px;
  margin: 0 auto;
}
.menu-main-title {
  font-family: Montserrat;
  font-weight: 800;
  font-size: 32px;
  line-height: 39.01px;
  max-width: 1100px;
  margin: 0 auto;
}
.menu-main {
  display: flex;
  justify-content: center;
  &__wrapper {
    display: flex;
    max-width: 1110px;
    width: 100%;
  }
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
    position: relative;
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
