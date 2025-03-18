<template>
  <div class="wrapper-ebmla">
    <div class="embla" ref="emblaRef">
      <div class="embla__viewport">
        <div class="embla__container">
          <div
            class="embla__slide"
            v-for="(slider, index) in newProducts"
            :key="index"
            :class="{ embla__selected: isSlideSelected(index) }"
            @click="addToBasket(slider.id)"
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
</template>
<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";

interface blocks {
  new: {
    id: number;
    name: string;
    image: string;
    price: number;
  }[];
}

const emit = defineEmits<{
  updateList: [isUpdate: boolean];
}>();

const basketStore = useBasketStore();

const newProducts = ref<blocks["new"]>([]);

const [emblaRef, emblaApi] = emblaCarouselVue({
  container: ".embla__container",
  loop: true,
  align: "start",
  startIndex: 1,
});
const baseUrl: string = "http://api.fibo.local/";
const selectedIndex = ref<number>(0);

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

const getNewProduct = async () => {
  try {
    await fetch(`${baseUrl}common/new`)
      .then((response) => {
        return response.json();
      })
      .then((data) => {
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
const addToBasket = <T extends number>(id: T) => {
  const item = {
    id: id,
    quantity: 1,
  };
  basketStore.basket.isVisible = false;
  basketStore.addToBasket(item);
  localStorage.setItem("basket", JSON.stringify(basketStore.basket));

  emit('updateList', true);
};



onMounted(() => {
  getNewProduct();
});
</script>
<style lang="scss" scoped>
.wrapper-ebmla {
  position: relative;
  display: flex;
}
.embla {
  overflow: hidden;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
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
    transform: translate(0, -50%);
    top: 50%;
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 450px;
  }
  &__selected {
    border: 2.5px solid rgba(247, 210, 45, 0.4);
    opacity: 1;
    transform: scale(1);
  }
}
</style>
