<template>
  <div class="burger-menu">
    <div class="burger-menu__wrapper">
      <MicroBasket v-if="showMicro" />
      <ul
        class="burger-menu__list"
        v-for="navigation in listNavigation"
        :key="navigation.id"
      >
        <RouterLink
          to="/contacts"
          class="burger-menu__list-item"
          v-if="navigation.name === 'Контакты'"
        >
          {{ navigation.name }}
        </RouterLink>
        <li v-else>
          <a class="burger-menu__list-item" href="#pizza">{{
            navigation.name
          }}</a>
        </li>
      </ul>

      <div class="burger-menu__function" v-if="!userStore.user?.id">
        <button @click="toggleModalAuth" class="burger-menu__function-signin">
          Войти
        </button>
        <button
          @click="toggleModalRegister"
          class="burger-menu__function-signin"
        >
          Регистрация
        </button>
      </div>
      <div class="burger-menu__function" v-else>
        <button @click="logout" class="burger-menu__function-signin">
          Выход
        </button>
      </div>
      <div class="burger-menu__function-basket" @click="showMicroBasket">
        Корзина
        <span class="burger-menu__count-product-in-basket">{{
          lengthBasket
        }}</span>
      </div>

      <RootModal
        @close="toggleModalAuth"
        v-if="openAuth"
        class="modal"
        :class="{ open: openAuth }"
      >
        <template v-slot:header>
          <div class="modal__header" id="header">
            <h2 class="modal__title">Вход на сайт</h2>
          </div>
        </template>
        <template v-slot:body>
          <div class="modal__body">
            <div class="modal__row-input">
              Номер телефона
              <input
                @input="checkNumberAuth"
                v-model="userAuthData.telephone"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error':
                    getAllErrorsAuth['telephone'],
                }"
                type="text"
              />
              <BlockError v-if="getAllErrorsAuth['telephone']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsAuth["telephone"] }}
                  </p>
                </template>
              </BlockError>
            </div>
            <div class="modal__row-input">
              Пароль
              <input
                v-model="userAuthData.password"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error': getAllErrorsAuth['password'],
                }"
                type="password"
              />
              <BlockError v-if="getAllErrorsAuth['password']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsAuth["password"] }}
                  </p>
                </template>
              </BlockError>
              <BlockError v-if="getAllErrorsAuth['try_again']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsAuth["try_again"] }}
                  </p>
                </template>
              </BlockError>
            </div>

            <div class="modal__row-footer">
              <button
                class="modal__row-footer-button"
                type="button"
                @click="auth"
              >
                Войти
              </button>
              <div class="modal__row-footer-policy">
                Продолжая, вы соглашаетесь со сбором и обработкой персональных
                данных и пользовательским соглашением
              </div>
            </div>
          </div>
        </template>
      </RootModal>
      <RootModal
        @close="toggleModalRegister"
        v-if="openRegister"
        class="modal"
        :class="{ open: openRegister }"
      >
        <template v-slot:header>
          <div class="modal__header" id="header">
            <h2 class="modal__title">Регистрация</h2>
          </div>
        </template>
        <template v-slot:body>
          <div class="modal__body">
            <div class="modal__row-input">
              Номер телефона
              <input
                @input="checkNumberRegister"
                v-model="userRegisterData.telephone"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error':
                    getAllErrorsRegister['telephone'],
                }"
                type="text"
              />
              <BlockError v-if="getAllErrorsRegister['telephone']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsRegister["telephone"] }}
                  </p>
                </template>
              </BlockError>
            </div>
            <div class="modal__row-input">
              Имя пользователя
              <input
                v-model="userRegisterData.name"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error': getAllErrorsRegister['name'],
                }"
                type="tel"
              />
              <BlockError v-if="getAllErrorsRegister['name']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsRegister["name"] }}
                  </p>
                </template>
              </BlockError>
            </div>
            <div class="modal__row-input">
              Пароль
              <input
                v-model="userRegisterData.password"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error':
                    getAllErrorsRegister['password'],
                }"
                type="password"
              />
              <BlockError v-if="getAllErrorsRegister['password']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsRegister["password"] }}
                  </p>
                </template>
              </BlockError>
            </div>
            <div class="modal__row-input">
              Подтверждение пароля
              <input
                v-model="userRegisterData.confirmPassword"
                class="modal__row-input-border"
                :class="{
                  'modal__row-input-border-error':
                    getAllErrorsRegister['confirmPassword'],
                }"
                type="password"
              />
              <BlockError v-if="getAllErrorsRegister['confirmPassword']">
                <template v-slot:body>
                  <p class="error-block__text">
                    {{ getAllErrorsRegister["confirmPassword"] }}
                  </p>
                </template>
              </BlockError>
            </div>
            <div class="modal__row-footer">
              <button
                class="modal__row-footer-button"
                type="button"
                @click="register"
              >
                Регистрация
              </button>
              <div class="modal__row-footer-policy">
                Продолжая, вы соглашаетесь со сбором и обработкой персональных
                данных и пользовательским соглашением
              </div>
            </div>
          </div>
        </template>
      </RootModal>
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref, watchEffect } from "vue";
import RootModal from "../Modal/RootModal.vue";
import BlockError from "../UI/BlockError.vue";
import { useUserStore } from "../../../stores/useUserStore.ts";
import { useBasketStore } from "../../../stores/useBasketStore.ts";
import MicroBasket from "../UI/MicroBasket.vue";

interface Navigation {
  id: number;
  name: string;
  anchor: string;
}
interface UserAuth {
  telephone: string;
  password: string;
  try_again: string;
}
interface UserRegister {
  telephone: string;
  name: string;
  password: string;
  confirmPassword: string;
}
interface Errors {
  telephone: string;
  name: string;
  password: string;
  confirmPassword: string;
}
[];
interface ErrorsAuth {
  telephone: string;
  password: string;
  try_again: string;
}
[];

const userStore = useUserStore();

const basketStore = useBasketStore();

const lengthBasket = ref(0);
const openAuth = ref(false);
const openRegister = ref(false);
const showMicro = ref(false);
defineProps<{
  listNavigation: Navigation[];
}>();

const baseUrl: string = "http://api.fibo.local/";

const userAuthData = ref<UserAuth>({
  telephone: "",
  password: "",
  try_again: "",
});
const userRegisterData = ref<UserRegister>({
  telephone: "",
  name: "",
  password: "",
  confirmPassword: "",
});

const checkNumberAuth = () => {
  const number = userAuthData.value.telephone.toString().replace(/[^0-9]/g, "");

  if (number.length < 11) {
    const pattern = new RegExp(
      `^(\\d{${number.length}})(\\d{3})(\\d{3})(\\d{2})(\\d{2})$`
    );
    const formattedNumber = number.replace(pattern, "+$1 ($2) $3-$4-$5");
    userAuthData.value.telephone = formattedNumber;
  } else {
    userAuthData.value.telephone = number.slice(0, 11);
  }
};
const checkNumberRegister = () => {
  const number = userRegisterData.value.telephone
    .toString()
    .replace(/[^0-9]/g, "");

  if (number.length < 11) {
    const pattern = new RegExp(
      `^(\\d{${number.length}})(\\d{3})(\\d{3})(\\d{2})(\\d{2})$`
    );
    const formattedNumber = number.replace(pattern, "+$1 ($2) $3-$4-$5");
    userRegisterData.value.telephone = formattedNumber;
  } else {
    userRegisterData.value.telephone = number.slice(0, 11);
  }
};

const toggleModalAuth = () => {
  openAuth.value = !openAuth.value;
  if (openAuth.value) {
    document.body.classList.add("scroll-hidden");
    window.scrollTo(0, 0);
  } else {
    document.body.classList.remove("scroll-hidden");
  }
};
const toggleModalRegister = () => {
  openRegister.value = !openRegister.value;
  if (openRegister.value) {
    document.body.classList.add("scroll-hidden");
    window.scrollTo(0, 0);
  } else {
    document.body.classList.remove("scroll-hidden");
  }
};

const getAllErrorsRegister = ref<Errors>({
  telephone: "",
  name: "",
  password: "",
  confirmPassword: "",
});
const getAllErrorsAuth = ref<ErrorsAuth>({
  telephone: "",
  password: "",
  try_again: "",
});

const auth = async () => {
  try {
    await fetch(`${baseUrl}user/auth`, {
      method: "POST",
      body: JSON.stringify(userAuthData.value),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.status === "error") {
          getAllErrorsAuth.value = data.error;
        } else {
          document.cookie = `token=${data.token}`;
          userStore.setUser(data.data);
          toggleModalAuth();
        }
      });
  } catch (err) {
    console.log(err);
  }
};
const register = async () => {
  try {
    getAllErrorsRegister.value = <Errors>{};
    await fetch(`${baseUrl}user/register`, {
      method: "POST",
      body: JSON.stringify(userRegisterData.value),
      mode: "cors",
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        if (data.status === "error") {
          getAllErrorsRegister.value = data.error;
        }
      });
  } catch (err) {
    console.log(err);
  }
};

const logout = () => {
  userStore.setUser({});
  document.cookie = `token=`;
};

const getLengthBasket = () => {
  lengthBasket.value = basketStore.getTotalItems;
};

const showMicroBasket = () => {
  showMicro.value = !showMicro.value;
};

watchEffect(getLengthBasket);

onMounted(() => {
  getLengthBasket();
});
</script>
<style scoped lang="scss">
.burger-menu {
  display: flex;
  justify-content: center;
  padding-top: 20px;
  padding-bottom: 41px;
  &__wrapper {
    position: relative;
    max-width: 1110px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  &__list {
    display: flex;
    gap: 15px;
  }

  &__list-item {
    color: #000;
    font-weight: 600;
    font-size: 15px;
    line-height: 18.29px;
  }

  &__function {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  &__function-signin {
    font-weight: 700;
    font-size: 16px;
    line-height: 28px;
    color: hsla(219, 7%, 45%, 1);
  }
  &__function-basket {
    background-color: hsla(49, 93%, 57%, 1);
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    line-height: 28px;
    color: hsla(345, 6%, 13%, 1);
    padding: 7px 25px;
    cursor: pointer;
  }
  &__count-product-in-basket {
    padding-left: 25px;
    position: relative;
  }
  &__count-product-in-basket::after {
    content: "";
    width: 2px;
    height: 23px;
    background-color: hsla(345, 6%, 13%, 1);
    position: absolute;
    left: 7px;
    top: 0;
  }
}

.modal {
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 10;
  transform: translateX(-100%);
  transition: transform 0.5s ease-in-out;
  background: linear-gradient(
      0deg,
      rgba(33, 49, 52, 0.2),
      rgba(33, 49, 52, 0.2)
    ),
    linear-gradient(0deg, rgba(247, 210, 45, 0.4), rgba(247, 210, 45, 0.4));
  text-align: center;
  white-space: nowrap;
  &__body {
    gap: 30px;
    display: grid;
  }
  &__title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 32px;
    line-height: 17px;
    letter-spacing: 0%;
    padding-bottom: 41px;
  }
  &__row-input {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 28px;
    letter-spacing: 0%;
    color: rgba(104, 100, 102, 1);
    display: grid;
    grid-template-columns: 158px 1fr;
    align-items: center;
  }
  &__row-input-border {
    border: 1.5px solid rgba(226, 226, 233, 1);
    border-radius: 8px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0%;
    color: rgba(35, 31, 32, 1);
    padding: 10px 19px 10px 19px;
    margin-left: 32px;
    max-width: 225px;
  }
  &__row-input-border-error {
    border: 1.5px solid rgba(255, 46, 101, 1);
  }
  &__row-footer {
    text-wrap: auto;
    display: grid;
    grid-template-columns: 224px 1fr;
    color: rgba(157, 157, 155, 1);
  }
  &__row-footer-button {
    background: rgba(247, 210, 45, 1);
    color: rgba(255, 255, 255, 1);
    border-radius: 8px;
    padding: 14px 59px;
    font-family: Montserrat;
    font-weight: 800;
    font-size: 15px;
    line-height: 28px;
    letter-spacing: 0%;
    text-decoration: none;
  }
  &__row-footer-policy {
    font-family: Montserrat;
    font-weight: 600;
    font-size: 13px;
    line-height: 19px;
    text-decoration: underline;
    text-decoration-style: solid;
    padding-left: 24px;
    max-width: 319px;
  }
}
.modal.open {
  transform: translateX(0);
}
</style>
