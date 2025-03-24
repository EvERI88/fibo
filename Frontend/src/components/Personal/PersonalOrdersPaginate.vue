<template>
  <div class="paginate">
    <div class="paginate__order-wrapper">
      <div class="paginate__order-wrapper-button-prev" @click="prevPage"><</div>
      <!-- <div class="paginate__order-wrapper-text">{{ currentList }}</div> -->
      <div
        class="paginate__order-wrapper-text"
        v-for="(number, index) in listNumber.number"
        :key="index"
        :class="{
          'paginate__order-wrapper-text-selected': number === currentList,
        }"
        @click="selectNumber(number)"
      >
        <p>{{ number }}</p>
      </div>
      <div class="paginate__order-wrapper-button-next" @click="nextPage">></div>
    </div>
  </div>
</template>
<script setup lang="ts">
interface List {
  number: number[];
}

const props = defineProps<{
  currentList: number;
  totalPage: number;
  listNumber: List;
}>();
const emit = defineEmits<{
  nextPage: [list: number];
  prevPage: [list: number];
  changeCurrentList: [number: number];
}>();

const nextPage = () => {
  if (props.totalPage !== props.currentList) {
    emit("nextPage", props.currentList);
  }
};
const prevPage = () => {
  if (props.currentList !== 1) emit("prevPage", props.currentList);
};

const selectNumber = (number: number) => {
  emit("changeCurrentList", number);
};
</script>
<style lang="scss">
.paginate {
  position: absolute;
  z-index: 1;
  &__order-wrapper {
    display: flex;
    gap: 10px;
    align-items: center;
  }
  &__order-wrapper-button-prev,
  &__order-wrapper-button-next {
    background-color: var(--col-title);
    color: #000;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
  &__order-wrapper-text {
    background: #f3f3f7;
    color: #696f7a;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
  &__order-wrapper-text-selected {
    background-color: var(--col-title);
    color: #000;
    border-radius: 50%;
    height: 30px;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
  }
}
</style>
