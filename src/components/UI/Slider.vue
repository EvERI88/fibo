<template>
  <div class="embla" ref="emblaRef">
    <div class="embla__viewport">
      <div class="embla__container">
        <div
          class="embla__slide"
          v-for="(slider, index) in sliderImg"
          :key="index"
          :class="{ embla__selected: isSlideSelected(index) }"
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
      selectedIndex.value = emblaApi.value?.selectedScrollSnap() ?? 0;
    });
  }
});

const scrollToPrev = (): void => {
  if (emblaApi.value) {
    emblaApi.value.scrollPrev();
    selectedIndex.value = emblaApi.value?.selectedScrollSnap() ?? 0;
  }
};

const scrollToNext = (): void => {
  if (emblaApi.value) {
    emblaApi.value.scrollNext();
    selectedIndex.value = emblaApi.value?.selectedScrollSnap() ?? 0;
  }
};
</script>
<style scoped lang="scss">
.embla {
  position: relative;
  overflow: hidden;
  width: 100%;
  &__container {
    display: flex;
    gap: 30px;
  }
  &__viewport {
    width: 1100px;
    margin: 0 auto;
  }
  &__slide {
    flex: 0 0 calc(50% - 15px);
    min-width: 0;
    width: 100%;
  }
  &_slide-img {
    height: 100%;
    object-fit: cover;
    object-position: left;
    border-radius: 15px;
    box-shadow: 0px 4px 24px 0px rgba(0, 0, 0, 0.26);
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
</style>
