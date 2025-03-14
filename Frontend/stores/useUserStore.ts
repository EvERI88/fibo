import { defineStore } from "pinia";
import { ref } from "vue";

export const useUserStore = defineStore("user", () => {
  const user = ref({});

  const setUser = (userInfo: Object) => {
    user.value = userInfo;
  };

  return { user, setUser };
});
