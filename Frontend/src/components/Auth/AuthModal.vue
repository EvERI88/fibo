<template>
  <div class="wrapper modal">
    <h2 class="modal__title">Вход на сайт</h2>
    <div class="modal__row-input">
      Номер телефона
      <input class="modal__row-input-border" type="text" />
    </div>
    <div class="modal__row-input">
      Пароль
      <input class="modal__row-input-border" type="password" />
    </div>

    <div class="modal__row-footer">
      <button class="modal__row-footer-button" type="button">
        Выслать код
      </button>
      <div class="modal__row-footer-policy">
        Продолжая, вы соглашаетесь со сбором и обработкой персональных данных и
        пользовательским соглашением
      </div>
    </div>
  </div>
</template>
<script setup></script>
<style lang="scss">
.wrapper {
  max-width: 668px;
  padding: 40px 60px 40px 40px;
  width: 100%;
  background-color: #fff;
}
.modal::before {
  content: "";
  position: absolute;
  right: 31px;
  top: 29px;
  width: 40px;
  height: 40px;
  background-image: url("img/auth/Close.png");
}
.modal {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: left;
  text-align: left;
  gap: 30px;
  margin: auto;
  margin-top: auto;
  margin-top: 200px;
  border-radius: 12px;
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
</style>
