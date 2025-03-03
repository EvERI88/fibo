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

interface PizzaList {
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

const pizzaList: PizzaList[] = [
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
main::after {
  background-image: url("/img/background-male/body-male.png");
  content: "";
  position: absolute;
  left: 0;
  height: 402px;
  width: 100%;
  background-repeat: no-repeat;
  top: 20%;
}
</style>
