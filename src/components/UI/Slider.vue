<template>
  <div class="embla" ref="emblaRef">
    <div class="embla__viewport">
      <div class="embla__container">
        <div
          class="embla__slide"
          v-for="(slider, index) in sliderImg"
          :key="index"
          :class="{ selected: isSlideSelected(index) }"
        >
          <img
            class="embla_slide-img"
            :src="`/img/sliderImg/slide${slider.img}.png`"
            alt=""
          />
        </div>
      </div>
      <div class="embla__btn">
        <button class="embla__prev" @click="scrollToPrev">
          <img src="/img/prev/left.png" alt="" />
        </button>
        <button class="embla__next" @click="scrollToNext">
          <img src="/img/prev/right.png" alt="" />
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import emblaCarouselVue from "embla-carousel-vue";
import { ref, onMounted } from "vue";

defineProps({
  sliderImg: {
    type: Array,
    required: true,
  },
});

const [emblaRef, emblaApi] = emblaCarouselVue({
  container: ".embla__container",
  loop: false,
  containScroll: false,
  align: "start",
  // slidesToScroll: 2,
});

const selectedIndex = ref(0);

const isSlideSelected = (index) => {
  const start = selectedIndex.value;
  const end = selectedIndex.value + 1;

  return index >= start && index <= end;
};

onMounted(() => {
  if (emblaApi.value) {
    emblaApi.value.on("select", () => {
      selectedIndex.value = emblaApi.value.selectedScrollSnap();
    });
  }
});

const scrollToPrev = () => {
  if (emblaApi.value) {
    emblaApi.value.scrollPrev();
    selectedIndex.value = emblaApi.value.selectedScrollSnap();
  }
};

const scrollToNext = () => {
  if (emblaApi.value) {
    emblaApi.value.scrollNext();
    selectedIndex.value = emblaApi.value.selectedScrollSnap();
  }
};
</script>

<style scoped>
.embla__slide {
  transform: scale(0.9);
}
.selected {
  border: 5px solid red;
  transform: scale(1);
  transition: 1000ms;
}
</style>
