<template>
  <div class="feedback">
    <button class="feedback__telephone-btn">Заказать звонок</button>
    <span class="feedback__telephone-text">
      <a href="tel:+7 499 391-84-49" class="col-yellow"> 8 499 391-84-49 </a>
    </span>
  </div>
</template>
<style scoped lang="scss">
.feedback {
  display: flex;
  flex: 0 0 auto;
  gap: 1rem;
  &__telephone-btn {
    background: #f3f3f7;
    color: #696f7a;
    border-radius: 28px;
    padding: 0 1.5rem;
    font-weight: 700;
    font-size: 0.9rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
  }

  &__telephone-text {
    font-family: Montserrat, sans-serif;
    font-weight: 700;
    font-size: 1.5rem;
    line-height: 1.2;
    white-space: nowrap;
  }
}
</style>
