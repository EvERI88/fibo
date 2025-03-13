<template>
  <div class="burger-menu">
    <div class="burger-menu__wrapper">
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
      <div class="burger-menu__function">
        <button @click="toggleModalAuth" class="burger-menu__function-signin">
          Войти
        </button>
        <div class="burger-menu__function-basket">
          Корзина <span class="burger-menu__count-product-in-basket">1</span>
        </div>
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
                @input="checkNumber"
                v-model.number="userAuthData.telephone"
                class="modal__row-input-border"
                type="tel"
              />
            </div>
            <div class="modal__row-input">
              Пароль
              <input class="modal__row-input-border" type="password" />
            </div>
            <div class="modal__row-footer">
              <button
                class="modal__row-footer-button"
                type="button"
                @click="auth"
              >
                Выслать код
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
import { ref, watchEffect } from "vue";
import RootModal from "../Modal/RootModal.vue";

interface Navigation {
  id: number;
  name: string;
  anchor: string;
}
interface User {
  telephone: string;
  password: string;
}

const openAuth = ref(false);

defineProps<{
  listNavigation: Navigation[];
}>();

const baseUrl: string = "http://api.fibo.local/";

const userAuthData = ref<User>({
  telephone: "",
  password: "",
});

const checkNumber = () => {
  const number = userAuthData.value.telephone.toString().replace(/[^0-9]/g, "");

  if (number.length < 11) {
    const pattern = new RegExp(
      `^(\\d{${number.length}})(\\d{3})(\\d{3})(\\d{2})(\\d{2})$`
    );
    const formattedNumber = number.replace(pattern, "+$1 ($2) $3-$4-$5");
    userAuthData.value.telephone = formattedNumber;
    console.log("Отформатированный номер:", formattedNumber);
  } else {
    userAuthData.value.telephone = number.slice(0, 11);
    console.log("Срезанный номер:", userAuthData.value.telephone);
  }
};

watchEffect(() => checkNumber());

const toggleModalAuth = () => {
  openAuth.value = !openAuth.value;
  if (openAuth.value) {
    document.body.classList.add("scroll-hidden");
    window.scrollTo(0, 0);
  } else {
    document.body.classList.remove("scroll-hidden");
  }
};

const auth = async () => {
  try {
    await fetch(`${baseUrl}auth`, {
      method: "POST",
      body: JSON.stringify(userAuthData),
    })
      .then((response) => {
        return response.json();
      })
      .then((data) => {
        console.log(data);
      });
  } catch (err) {
    console.log(err);
  }
};
</script>
<style scoped lang="scss">
.burger-menu {
  display: flex;
  justify-content: center;
  padding-top: 20px;
  padding-bottom: 41px;
  &__wrapper {
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
    padding-right: 31px;
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
    grid-template-columns: 118px 1fr;
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
