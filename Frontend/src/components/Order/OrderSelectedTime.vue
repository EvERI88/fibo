<template>
  <RootModal>
    <template v-slot:header>
      <div class="modal__header" id="header">
        <h2 class="modal__title">Время доставки</h2>
      </div>
    </template>
    <template v-slot:body>
      <div class="modal__body">
        <div
          class="modal__item-time"
          v-for="time in currentTime"
          @click="changeTime(time.timeStart)"
          :class="{
            'modal__item-time-selected': selectedTime === time.timeStart,
          }"
        >
          {{ time.timeStart }} - {{ time.timeEnd }}
        </div>
      </div>
    </template>
  </RootModal>
</template>
<script setup lang="ts">
import { ref } from "vue";
import RootModal from "../Modal/RootModal.vue";

interface Times {
  time: {
    timeStart: string;
    timeEnd: string;
  }[];
}
const selectedTime = ref("");

const emit = defineEmits<{
  emitChangeTime: [emitChangeTime: string];
}>();

const currentTime = ref<Times["time"]>([
  { timeStart: "Побыстрее", timeEnd: "" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
  { timeStart: "15:00", timeEnd: "15:30" },
]);

const changeTime = <T extends string>(time: T) => {
  selectedTime.value = time;
  emit("emitChangeTime", time);
};
</script>
<style lang="scss" scoped>
.modal {
  transform: none;
  &__wrapper {
    background-color: rgba(227, 236, 245, 1);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
  }
  &__body {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
}
.modal {
  &__title {
    color: rgba(105, 111, 122, 1);
  }
  &__item-time {
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    background: rgba(255, 255, 255, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    padding: 12px 0 12px 19px;
    border-radius: 8px;
  }
  &__item-time-selected {
    border: 2px solid rgba(247, 210, 45, 1);
  }
}
</style>
