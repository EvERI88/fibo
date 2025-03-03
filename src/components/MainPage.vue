<template>
  <main>
    <Slider :sliderImg="sliderImg" />
    <MainNew :newProducts="newProducts" />
    <MainMenu :listMenu="listMenu" />
  </main>
</template>
<script setup lang="ts">
import MainMenu from "./Main/MainMenu.vue";
import MainNew from "./Main/MainNew.vue";
import Slider from "./UI/Slider.vue";

interface SliderImg {
  img: string;
}

interface blocks {
  new: {
    id: number;
    name: string;
    img: string;
    price: number;
  }[];
  menu: {
    id: number;
    name: string;
    products: {
      id: number;
      name: string;
      price: number;
      image: string;
      is_new: boolean;
      description: string;
    }[];
  }[];
}

const newProducts: blocks["new"] = [
  { id: 1, name: "Карбонара", img: "newPizza", price: 120 },
  { id: 2, name: "Карбонара", img: "newPizza", price: 120 },
  { id: 3, name: "Карбонара", img: "newPizza", price: 120 },
  { id: 4, name: "Карбонара", img: "newPizza", price: 120 },
];

const sliderImg: SliderImg[] = [
  { img: "1" },
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];

const listMenu: blocks["menu"] = [
  {
    id: 1,
    name: "Паста",
    products: [
      {
        id: 10,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 11,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
      {
        id: 12,
        name: "С креветками и трюфелями",
        price: 600,
        image: "pizza1",
        is_new: true,
        description:
          "Домашнаяя паста феттуччине, сливочный соус, креветки, трюфельное масло, черный перец, пармезан.350 г",
      },
    ],
  },
];
</script>

<style lang="scss" scoped>
main::after {
  background-image: url("/img/background-male/body-male.png");
  content: "";
  position: absolute;
  left: 0;
  height: 402px;
  width: 168px;
  background-repeat: no-repeat;
  top: 20%;
}
</style>
