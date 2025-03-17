import { defineStore } from "pinia";
import { ref, computed } from "vue";

export const useBasketStore = defineStore("basket", () => {
  interface CartItem {
    id: number;
    quantity: number;
  }

  interface Basket {
    isVisible: boolean
    items: CartItem[];
  }
  const visibleBasket = ref<Basket['isVisible']>(false);

  const basket = ref<Basket>({ items: [], isVisible: false });

  const addToBasket = (newItem: CartItem) => {
    const existingItem = basket.value.items.find(
      (item) => item.id === newItem.id
    );
    if (existingItem) {
      existingItem.quantity += newItem.quantity;
    } else {
      basket.value.items.push(newItem);
    }
  };
  const getTotalItems = computed(() => {
    return basket.value.items.reduce((total, item) => total + item.quantity, 0);
  });

  const removeToBasket = (id: number): void => {
    basket.value.items.splice(id, 1);
  };

  const clearBasket = () => {
    basket.value.items = [];
  };
  return { basket, addToBasket, getTotalItems, clearBasket, removeToBasket };
});
