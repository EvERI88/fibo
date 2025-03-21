<template>
  <div class="personal">
    <div class="personal__wrapper">
      <div class="personal__bonus-background">
        <div class="personal__bonus">
          <p class="personal__bonus-title">Мои бонусы</p>
          <ul class="personal__bonus-list">
            <li class="personal__bonus-list-item">
              <img
                src="/img/presonal/sale.png"
                alt=""
                class="personal__bonus-image"
              />
              <p class="personal__bonus-list-item-text">
                Бонусы появятся здесь после заказа
              </p>
            </li>
          </ul>
          <p class="personal__bonus-bottom">Все наши акции</p>
        </div>
      </div>
      <div class="personal__data">
        <p class="personal__data-title">Личные данные</p>
        <div class="personal__data-title-row">
          <p class="personal__data-title-row-placeholder">Имя</p>
          <div class="personal__data-title-row-input-wrapper">
            <input
              type="text"
              class="personal__data-title-row-input"
              v-model="user.name"
              :disabled="!change.name"
            />
            <div
              @click="changeData({ currentData: user.name, name: 'name' })"
              class="personal__data-title-row-button"
              v-if="!change.name"
            >
              Изменить
            </div>
            <div
              class="personal__data-title-row-button-save"
              v-if="change.name"
              @click="changeUserData"
            >
              Сохранить
            </div>
            <div
              class="personal__data-title-row-button-cancel"
              v-if="change.name"
              @click="
                () => {
                  change.name = false;
                  user.name = userStore.user?.name;
                  getAllErrorsUser = {
                    confirmedPassword: '',
                    verifiedPassword: '',
                    telephone: '',
                    password: '',
                  };
                }
              "
            >
              Отменить
            </div>
          </div>
        </div>
        <div class="personal__data-title-row">
          <p class="personal__data-title-row-placeholder">Номер телефона</p>
          <div class="personal__data-title-row-input-wrapper">
            <input
              type="text"
              class="personal__data-title-row-input"
              v-model="user.telephone"
              disabled
            />
          </div>
        </div>
        <div class="personal__data-title-row">
          <p class="personal__data-title-row-placeholder">Старый пароль</p>
          <div class="personal__data-title-row-input-wrapper">
            <input
              type="password"
              class="personal__data-title-row-input"
              v-model="user.setPassword.oldPassword"
              :disabled="!change.password"
            />
            <BlockError v-if="getAllErrorsUser.verifiedPassword">
              <template v-slot:body>
                <p class="error-block__text">
                  {{ getAllErrorsUser.verifiedPassword }}
                </p>
              </template>
            </BlockError>
            <div
              @click="
                changeData({
                  currentData: user.setPassword.oldPassword,
                  name: 'password',
                })
              "
              class="personal__data-title-row-button"
              v-if="!change.password"
            >
              Изменить
            </div>
            <div
              class="personal__data-title-row-button-save"
              v-if="change.password"
              @click="changeUserData"
            >
              Сохранить
            </div>
            <div
              class="personal__data-title-row-button-cancel"
              v-if="change.password"
              @click="
                () => {
                  change.password = false;
                  user.setPassword.newPassword = '';
                  user.setPassword.confirmNewPassword = '';
                  user.setPassword.oldPassword = '';
                  getAllErrorsUser = {
                    confirmedPassword: '',
                    verifiedPassword: '',
                    password: '',
                  };
                }
              "
            >
              Отменить
            </div>
          </div>
        </div>
        <div class="personal__data-title-row">
          <p class="personal__data-title-row-placeholder">Новый пароль</p>
          <div class="personal__data-title-row-input-wrapper">
            <input
              type="password"
              class="personal__data-title-row-input"
              v-model="user.setPassword.newPassword"
              :disabled="!change.password"
            />
          </div>
        </div>
        <div class="personal__data-title-row">
          <p class="personal__data-title-row-placeholder">
            Подтверждение нового пароль
          </p>
          <div class="personal__data-title-row-input-wrapper">
            <input
              type="password"
              class="personal__data-title-row-input"
              v-model="user.setPassword.confirmNewPassword"
              :disabled="!change.password"
            />
            <BlockError
              v-if="getAllErrorsUser.confirmedPassword === 'confirmedPassword'"
            >
              <template v-slot:body>
                <p class="error-block__text">
                  {{
                    getAllErrorsUser.confirmedPassword === "confirmedPassword"
                      ? "Проверьте все поля паролей"
                      : ""
                  }}
                </p>
              </template>
            </BlockError>
          </div>
        </div>
      </div>
      <div class="personal__subscribe">
        <div class="personal__subscribe-wrapper">
          <p class="personal__subscribe-title">Подписки</p>
          <div
            class="personal__subscribe-content"
            @click="user.subscribe = !user.subscribe"
          >
            <div
              class="personal__subscribe-content-radio-button"
              :class="{
                'personal__subscribe-content-radio-button-selected':
                  user.subscribe,
              }"
            ></div>
            <div class="personal__subscribe-content-text">
              Сообщать о бонусах, акциях и новых продуктах
            </div>
            <div class="personal__subscribe-content-icon">i</div>
          </div>
        </div>
      </div>
      <div class="personal__exit">
        <button type="button" class="personal__exit-button">Выйти</button>
      </div>
    </div>
    <RouterLink to="/personal-order" class="header__logo">
      Ваши заказы
    </RouterLink>
  </div>
</template>
<script lang="ts" setup>
import { ref } from "vue";
import { useUserStore } from "../../../stores/useUserStore.ts";
import BlockError from "../UI/BlockError.vue";

interface SetPassword {
  oldPassword: string;
  newPassword: string;
  confirmNewPassword: string;
}

interface User {
  name: string | undefined;
  telephone: string | undefined;
  subscribe: false | true;
  setPassword: SetPassword;
}
interface ErrorsAuth {
  password: string;
  confirmedPassword: string;
  verifiedPassword: string;
}
[];

interface Change {
  name: boolean;
  password: boolean;
}

const getAllErrorsUser = ref<ErrorsAuth>({
  password: "",
  confirmedPassword: "",
  verifiedPassword: "",
});

const baseUrl: string = "http://api.fibo.local/";
const userStore = useUserStore();
const user = ref<User>({
  name: userStore.user?.name,
  telephone: userStore.user?.telephone,
  subscribe: false,
  setPassword: {
    oldPassword: "",
    newPassword: "",
    confirmNewPassword: "",
  },
});

const change = ref<Change>({
  name: false,
  password: false,
});

const changeData = (data: {
  currentData: string | undefined;
  name: string;
}) => {
  if (data.name === "password") {
    change.value.password = true;
  }
  if (data.name === "name") {
    change.value.name = true;
  }
};

const changeUserData = async () => {
  getAllErrorsUser.value = {
    confirmedPassword: "",
    password: "",
    verifiedPassword: "",
  };

  if (
    user.value.setPassword.confirmNewPassword ===
      user.value.setPassword.newPassword &&
    !change.value.password
  ) {
    try {
      await fetch(`${baseUrl}user/update`, {
        method: "POST",
        body: JSON.stringify({
          id: userStore.user?.id,
          name: user.value.name,
          telephone: user.value.telephone,
          password: user.value.setPassword.oldPassword,
          new_password: user.value.setPassword.newPassword,
        }),
      })
        .then((response) => {
          return response.json();
        })
        .then((data: any) => {
          if (data["status"] === "error") {
            console.log(data.message);
            getAllErrorsUser.value.verifiedPassword = data.message;
          } else {
            window.location.reload();
          }
        });
    } catch (err) {}
  } else if (
    change.value.password &&
    user.value.setPassword.oldPassword.length !== 0 &&
    user.value.setPassword.newPassword.length !== 0 &&
    user.value.setPassword.confirmNewPassword ===
      user.value.setPassword.newPassword
  ) {
    try {
      await fetch(`${baseUrl}user/update`, {
        method: "POST",
        body: JSON.stringify({
          id: userStore.user?.id,
          name: user.value.name,
          telephone: user.value.telephone,
          password: user.value.setPassword.oldPassword,
          new_password: user.value.setPassword.newPassword,
        }),
      })
        .then((response) => {
          return response.json();
        })
        .then((data: any) => {
          if (data["status"] === "error") {
            console.log(data.message);
            getAllErrorsUser.value.verifiedPassword = data.message;
          } else {
            window.location.reload();
          }
        });
    } catch (err) {}
  } else {
    getAllErrorsUser.value.confirmedPassword = "confirmedPassword";
    console.log(getAllErrorsUser.value);
  }
};
</script>
<style lang="scss" scoped>
.error-block {
  margin-left: 0;
  max-width: 350px;
}
.personal {
  &__wrapper {
  }

  &__bonus-background {
    background: rgba(227, 236, 245, 1);
  }
  &__bonus {
    max-width: 1100px;
    margin: 0 auto;
    padding: 43px 0;
  }

  &__bonus-title {
    color: var(--col-title);
    font-family: Montserrat;
    font-weight: 800;
    font-size: 34px;
    line-height: 100%;
    padding-bottom: 33px;
  }

  &__bonus-list {
    padding-bottom: 42px;
  }

  &__bonus-list-item {
    background: rgba(255, 255, 255, 1);
    box-shadow: 0px 4px 28px 0px rgba(0, 0, 0, 0.08);
    max-width: 255px;
    padding: 38px 38px 100px 38px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 8px;
  }

  &__bonus-image {
  }

  &__bonus-list-item-text {
    padding-top: 32px;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 22px;
    text-align: center;
    color: rgba(104, 100, 102, 1);
  }

  &__bonus-bottom {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 100%;
    color: var(--col-title);
    text-decoration: dotted;
  }

  &__data {
    max-width: 1100px;
    margin: 0 auto;
    padding: 43px 0;
  }

  &__data-title {
    font-family: Montserrat;
    font-weight: 800;
    font-size: 30px;
    line-height: 100%;
    color: var(--col-title);
  }

  &__data-title-row {
    display: flex;
    flex-direction: column;
    max-width: 452px;
    padding-top: 9px;
  }

  &__data-title-row-placeholder {
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 28px;
    color: rgba(35, 31, 32, 1);
    max-width: 452px;
  }

  &__data-title-row-input {
    max-width: 350px;
    border: 1.5px solid rgba(227, 236, 245, 1);
    border-radius: 8px;
    background: rgba(241, 242, 245, 0.6);
    padding: 10px 119px 10px 19px;
    width: 100%;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
  }

  &__data-title-row-button {
    border: none;
    color: var(--col-title);
    position: absolute;
    right: 19px;
    top: 25px;
    transform: translate(0, -50%);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    text-align: right;
    cursor: pointer;
  }
  &__data-title-row-button-save {
    border: none;
    color: rgba(157, 157, 155, 1);
    position: absolute;
    right: -100px;
    top: 25px;
    transform: translate(0, -50%);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    text-align: right;
    cursor: pointer;
  }
  &__data-title-row-button-cancel {
    border: none;
    color: rgba(157, 157, 155, 1);
    position: absolute;
    right: -200px;
    top: 50%;
    transform: translate(0, -50%);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 15px;
    line-height: 28px;
    text-align: right;
    cursor: pointer;
  }
  &__data-title-row-input-wrapper {
    max-width: 350px;
    position: relative;
  }

  &__subscribe {
    max-width: 1100px;
    margin: 0 auto;
    padding-bottom: 13px;
  }

  &__subscribe-wrapper {
  }

  &__subscribe-title {
    font-family: Montserrat;
    font-weight: 800;
    font-size: 24px;
    line-height: 100%;
    color: var(--col-title);
    padding-bottom: 13px;
  }

  &__subscribe-content {
    display: flex;
    align-items: center;
    gap: 20px;
  }

  &__subscribe-content-radio-button {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(247, 210, 45, 1);
    border-radius: 50%;
    position: relative;
    cursor: pointer;
  }
  &__subscribe-content-radio-button-selected::before {
    width: 8px;
    height: 8px;
    background-color: rgba(247, 210, 45, 1);
    position: absolute;
    content: "";
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  &__subscribe-content-text {
  }

  &__subscribe-content-icon {
    background: rgba(241, 242, 245, 1);
    border-radius: 50%;
    font-family: Montserrat;
    font-weight: 700;
    font-size: 14px;
    line-height: 28px;
    width: 26px;
    height: 26px;
    text-align: center;
  }

  &__exit {
    max-width: 1100px;
    margin: 0 auto;
    padding-top: 42px;
    padding-bottom: 87px;
  }
  &__exit-button {
    background-color: rgba(227, 236, 245, 1);
    color: rgba(105, 111, 122, 1);
    font-family: Montserrat;
    font-weight: 700;
    font-size: 16px;
    line-height: 28px;
    padding: 12px 40px;
    border-radius: 8px;
  }
}
</style>
<!-- getAllErrorsUser.value.confirmedPassword = "confirmedPassword"; -->
<!-- console.log(getAllErrorsUser.value); -->
