<template>
  <div class="embla" ref="emblaRef">
    <div class="embla__viewport">
      <div class="embla__container">
        <div class="embla__slide" v-for="slider in sliderImg">
          <img class="embla_slide-img" :src="`/img/sliderImg/slide${slider.img}.png`" alt="" />
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
<script setup lang="ts">
import emblaCarouselVue from "embla-carousel-vue";
import EmblaCarousel from "embla-carousel";

defineProps({
  sliderImg: {
    type: Array,
  },
});

const [emblaRef, emblaApi] = emblaCarouselVue({
  container: ".embla__container",
  loop: false,
});

const scrollToPrev = () => {
  emblaApi.value.scrollPrev();
};

const scrollToNext = () => {
  emblaApi.value.scrollNext();
};
</script>
