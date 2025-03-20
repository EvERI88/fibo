<template>
  <RootModal @close="closeModal" class="modal">
    <template v-slot:header>
      <div class="modal__header" id="header">
        <h2 class="modal__title">Куда доставить?</h2>
      </div>
    </template>
    <template v-slot:body>
      <div class="modal__body">
        <div class="modal__delivery-wrapper">
          <div
            class="modal__delivery"
            :class="{
              'modal__delivery-selected': selectedMethodDelivery === 'Доставка',
            }"
            @click="selectedMethodDelivery = 'Доставка'"
          >
            Доставка
          </div>
          <div
            class="modal__delivery"
            :class="{
              'modal__delivery-selected':
                selectedMethodDelivery === 'Самовывоз',
            }"
            @click="selectedMethodDelivery = 'Самовывоз'"
          >
            Самовывоз
          </div>
        </div>
        <div class="modal__row-address">
          <input
            class="modal__row-input-border-big modal__row-input-border"
            type="text"
            placeholder="Город, Улица"
            v-model="infoAddress.address"
          />
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Дом"
            v-model="infoAddress.home"
          />
        </div>
        <div class="modal__row-address-fake">
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Кв"
            v-model="infoAddress.number"
          />
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Подъезд"
            v-model="infoAddress.numberPod"
          />
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Домофон"
            v-model="infoAddress.intercom"
          />
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Этаж"
            v-model="infoAddress.floor"
          />
        </div>
        <div class="modal__row-address-bred">
          <input
            class="modal__row-input-border"
            type="text"
            placeholder="Название адреса"
            v-model="infoAddress.name"
          />
          <p class="modal__row-text">
            Например <span class="modal__row-text-span">Дом</span> или
            <span class="modal__row-text-span">Работа</span>
          </p>
        </div>

        <div class="modal__row-input-area">
          <textarea
            class="modal__row-input-area-text"
            name=""
            id=""
            placeholder="Комментарий к адресу"
            v-model="infoAddress.comment"
          ></textarea>
        </div>
        <div
          class="modal__wrapper-error error-block"
          v-if="errors.errors.length >= 1"
        >
          <div v-for="error in errors.errors" class="modal__wrapper-error">
            {{ error.value }}
          </div>
        </div>
        <button
          type="button"
          class="modal__row-footer-delivery"
          @click="continueCreateOrder"
        >
          Подтвердить адрес
        </button>
      </div>
    </template>
  </RootModal>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import RootModal from "../Modal/RootModal.vue";
import { useRouter } from "vue-router";

const router = useRouter();
interface Address {
  address: string;
  home: number;
  number: number;
  numberPod: number;
  numberKV: number;
  intercom: string;
  floor: number;
  method: string;
  name: string;
  comment: string;
}
interface Errors {
  errors: {
    keyError: string;
    value: string;
  }[];
}
const selectedMethodDelivery = ref<String>("Доставка");

const errors = ref<Errors>({
  errors: [],
});

const infoAddress = ref<Address>({
  address: "",
  home: 0,
  number: 0,
  numberPod: 0,
  numberKV: 0,
  intercom: "",
  floor: 0,
  method: `${selectedMethodDelivery.value}`,
  name: "",
  comment: "",
});

const emit = defineEmits<{
  close: [open: boolean];
}>();

const closeModal = () => {
  emit("close", true);
};

const continueCreateOrder = () => {
  errors.value.errors.splice(0, errors.value.errors.length);

  if (infoAddress.value.address.length < 5) {
    console.log(infoAddress.value.address.length);

    errors.value?.errors.push({
      keyError: "address",
      value: "Несуществующий адрес",
    });
  }
  if (infoAddress.value.home < 1) {
    errors.value?.errors.push({
      keyError: "home",
      value: "Введите номер дома",
    });
  }
  if (infoAddress.value.number < 1) {
    errors.value?.errors.push({
      keyError: "number",
      value: "Введите номер квартиры",
    });
  }
  if (infoAddress.value.numberPod < 1) {
    errors.value?.errors.push({
      keyError: "numberPod",
      value: "Введите подъезд",
    });
  }
  if (infoAddress.value.intercom.length < 1) {
    errors.value?.errors.push({
      keyError: "intercom",
      value: "Укажите есть ли Домофон",
    });
  }
  if (infoAddress.value.floor < 1) {
    errors.value?.errors.push({
      keyError: "floor",
      value: "Укажите этаж",
    });
  }
  console.log(errors.value?.errors);

  router.push({ name: "order" });

  if (errors.value?.errors.length < 1) {
    localStorage.setItem("order", JSON.stringify(infoAddress.value));
    document.body.classList.remove("scroll-hidden");
  }
};
</script>
<style lang="scss" scoped>
.modal {
  transform: none;
  &__body {
    gap: 15px;
  }
  &__delivery-wrapper {
    gap: 15px;
    display: flex;
    padding-bottom: 20px;
  }
  &__delivery {
    padding: 9px 36px;
    border-radius: 8px;
    max-width: 166px;
    display: flex;
    justify-content: center;
    cursor: pointer;
    background: rgba(243, 243, 247, 1);
    font-family: Montserrat;
    font-weight: 600;
    font-size: 18px;
    line-height: 28px;
    color: rgba(130, 135, 146, 1);
  }
  &__delivery-selected {
    background: rgba(247, 210, 45, 1);
    color: #000;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 18px;
    line-height: 28px;
  }
  &__row-input-border {
    max-width: none;
  }
  &__row-address {
    display: grid;
    grid-template-columns: 1fr 133px;
    gap: 15px;
    justify-content: space-between;
  }

  &__row-address-fake {
    display: grid;
    grid-template-columns: 133px 133px 133px 133px;
    gap: 14px;
    justify-content: space-between;
  }
  &__row-input-border {
    margin: 0;
  }
  &__row-input-border-big {
    max-width: 449px;
  }
  &__row-address-bred {
    width: 100%;
    display: grid;
  }
  &__row-text {
    padding-top: 15px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 28px;
    color: gray;
  }
  &__row-text-span {
    color: var(--col-title);
  }
  &__row-input-area-text {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 8px;
    padding: 10px 0 20px 19px;
    width: 100%;
    resize: none;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
  }
  &__row-footer-delivery {
    background: rgba(247, 210, 45, 1);
    color: #000;
    padding: 14px 25px;
    font-family: Montserrat;
    font-weight: 800;
    font-size: 15px;
    line-height: 28px;
    border-radius: 8px;
    max-width: 224px;
  }
  .error-block {
    grid-column: auto;
    display: flex;
    max-width: none;
    margin-left: 0;
  }
  &__wrapper-error {
    display: flex;
    width: 100%;
    flex-direction: column;
    gap: 15px;
    padding: 5px 15px;
  }
}
</style>
