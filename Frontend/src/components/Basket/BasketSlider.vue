<template>
  <div class="embla" ref="emblaRef">
    <div class="embla__viewport">
      <div class="embla__container">
        <div
          class="embla__slide"
          v-for="(slider, index) in itemsInBasket"
          :key="index"
          :class="{ embla__selected: isSlideSelected(index) }"
        >
          <img
            class="embla__slide-img"
            :src="
              slider.image === 'none'
                ? `http://api.fibo.local/images/products/none.jpg`
                : `http://api.fibo.local/${slider.image}`
            "
            :alt="`http://api.fibo.local/images/products/none.jpg`"
          />
          <div class="embla__slide-info">
            <p>{{ slider.name }}</p>
            <p class="embla__slide-info-price">{{ slider.price }} ₽</p>
          </div>
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
import { onMounted, ref } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";

const basketStore = useBasketStore();
const [emblaRef, emblaApi] = emblaCarouselVue({
  container: ".embla__container",
  loop: true,
  align: "start",
  startIndex: 1,
});
const baseUrl: string = "http://api.fibo.local/";
const selectedIndex = ref<number>(0);

const itemsInBasket = ref();

const isSlideSelected = (index: number): boolean => {
  const start = selectedIndex.value;
  const end = selectedIndex.value + 1;

  return index >= start && index <= end;
};

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

const getProduct = async () => {
  const idProducts: number[] = basketStore.basket.items.reduce<number[]>(
    (array, item) => {
      array.push(item.id);
      return array;
    },
    []
  );
  try {
    await fetch(`${baseUrl}common/basket`, {
      method: "POST",
      body: JSON.stringify({ products: idProducts }),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.status === "error") {
          //   emptyBasket.value = true;
        }
        console.log(data);
        data.products
          ? (itemsInBasket.value = data.products)
          : (data.products = []);
      });
  } catch (err) {
    console.log(err);
  }
};

onMounted(() => {
  getProduct();
});
</script>
<style lang="scss" scoped>
.embla {
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
  &__slide-img {
    width: 71px;
  }
  &__slide {
    flex: 0 0 calc(22%);
    border: 2.5px solid rgba(247, 210, 45, 0.4);
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 14px 9px 14px 17px;
  }
  &_slide-img {
    height: 100%;
    object-fit: cover;
    object-position: left;
    border-radius: 15px;
  }
  &__btn {
    position: absolute;
    transform: translate(13px, -50%);
    top: 462px;
    justify-content: space-between;
    display: flex;
    max-width: 1100px;
    left: 100px;
    right: 100px;
    margin: 0 auto;
  }
  &__selected {
    border: 2.5px solid rgba(247, 210, 45, 0.4);
    opacity: 1;
    transform: scale(1);
  }
}
</style>
