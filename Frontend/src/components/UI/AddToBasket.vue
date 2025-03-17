<template>
  <div class="micro-basket__bottom">
    <p class="micro-basket__bottom-text" v-if="basketStore.basket.allPrice">
      Сумма заказа
      <span class="micro-basket__bottom-text-price">{{
        basketStore.basket.allPrice
      }}</span>
    </p>
    <p class="micro-basket__bottom-question">Добавить к заказу?</p>
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
              class="embla_slide-img"
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
  </div>
  <RouterLink
    to="/basket"
    class="burger-menu__list-item"
    @click="basketStore.basket.isVisible = false"
  >
    Перейти в корзину
  </RouterLink>
</template>
<script setup lang="ts">
import { ref, onMounted } from "vue";
import emblaCarouselVue from "embla-carousel-vue";
import { useBasketStore } from "../../../stores/useBasketStore.ts";

const basketStore = useBasketStore();

interface SliderImage {
  img: string;
}

defineProps<{
  sliderImg: SliderImage[];
  finalPrice: number;
}>();

interface blocks {
  new: {
    id: number;
    name: string;
    image: string;
    price: number;
  }[];
}

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
};
onMounted(() => {
  getNewProduct();
});
</script>
<style lang="scss" scoped>
.micro-basket {
  &__bottom {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
  }
  &__bottom-text {
    display: flex;
    justify-content: space-between;
  }
  &__bottom-text-price {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 24px;
    line-height: 100%;
    text-align: right;
  }
  &__bottom-question {
    padding: 20px 0;
    font-family: Montserrat;
    font-weight: 600;
    font-size: 16px;
    line-height: 17px;
    color: rgba(255, 46, 101, 1);
  }
}
.embla {
  position: relative;
  overflow: hidden;
  width: 100%;
  &__container {
    display: flex;
    gap: 30px;
  }
  &__viewport {
    width: 500px;
    margin: 0 auto;
  }
  &__slide {
    flex: 0 0 calc(50% - 15px);
    min-width: 0;
    width: 100%;
    display: flex;
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 12px;
    padding: 14px;
  }
  &__slide-info {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: left;
    padding-left: 15px;
  }

  &__slide-info-price {
    color: rgba(255, 46, 101, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 100%;
  }
  &_slide-img {
    height: 100%;
    width: 40%;
    object-fit: cover;
    object-position: left;
    border-radius: 15px;
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
    opacity: 0.6;
  }
  &__selected {
    opacity: 1;
    transform: scale(1);
    border: 2.5px solid rgba(247, 210, 45, 0.4);
  }
}
</style>
