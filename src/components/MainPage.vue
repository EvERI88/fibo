<template>
  <Slider />
</template>
<script setup>
import Slider from "./UI/Slider.vue";

const sliderImg = [
  { img: "1" },
  { img: "2" },
  { img: "1" },
  { img: "2" },
  { img: "2" },
];
</script>

<style>
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
}
.embla__slide {
  flex: 0 0 50%;

  min-width: 0;
}

.embla__btn {
  position: absolute;
  top: 50%;
  width: 100%;
  display: flex;
  justify-content: space-between;
}
</style>
