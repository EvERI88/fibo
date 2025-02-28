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

<script setup lang="ts">
import { ref, onMounted } from "vue";
import emblaCarouselVue from "embla-carousel-vue";

interface SliderImage {
  img: string;
}

defineProps<{
  sliderImg: SliderImage[];
}>();

const [emblaRef, emblaApi] = emblaCarouselVue({
  container: ".embla__container",
  loop: false,
  align: "start",
  startIndex: 1,
});

const selectedIndex = ref<number>(1);

const isSlideSelected = (index: number): boolean => {
  const start = selectedIndex.value;
  const end = selectedIndex.value + 1;

  return index >= start && index <= end;
};

onMounted(() => {
  if (emblaApi.value) {
    emblaApi.value.on("select", () => {
      selectedIndex.value = emblaApi.value?.selectedScrollSnap() || 0;
    });
  }
});

const scrollToPrev = (): void => {
  if (emblaApi.value) {
    emblaApi.value.scrollPrev();
    selectedIndex.value = emblaApi.value?.selectedScrollSnap() || 0;
  }
};

const scrollToNext = (): void => {
  if (emblaApi.value) {
    emblaApi.value.scrollNext();
    selectedIndex.value = emblaApi.value?.selectedScrollSnap() || 0;
  }
};
</script>

<style scoped>
.embla__slide {
  transform: scale(0.9);
  transition: 1000ms;
}
.selected {
  transform: scale(1);
  transition: 1000ms;
}
</style>
