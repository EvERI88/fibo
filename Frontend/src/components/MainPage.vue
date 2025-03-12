<template>
  <main>
    <Slider :sliderImg="sliderImg" />
    <MainNew :newProducts="newProducts" />
    <MainMenu :listMenu="listMenu" />
  </main>
</template>
<script setup lang="ts">
import { onMounted, ref } from "vue";
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
    image: string;
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

const baseUrl: string = "http://api.fibo.local/";

const sliderImg: SliderImg[] = [
  { img: "1" },
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];

const newProducts = ref<blocks["new"]>([]);

const listMenu = ref<blocks["menu"]>([]);

const getAllMenu = async () => {
  try {
    await fetch(`${baseUrl}common/menu`)
      .then((response) => {
        console.log(response);

        return response.json();
      })
      .then((data) => {
        const products = data.menu;
        for (let i = 0; i < products.length; i++) {
          const el = products[i];
          listMenu.value.push(el);
        }
      });
  } catch (err) {
    console.log(err);
  }
};

const getNewProduct = async () => {
  try {
    await fetch(`${baseUrl}common/new`)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        console.log(data);

        const products = data.new.products;
        for (let i = 0; i < products.length; i++) {
          const el = products[i];
          newProducts.value.push(el);
        }
      });
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  getNewProduct();
  getAllMenu();
});
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
