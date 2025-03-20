import { defineStore } from "pinia";
import { ref } from "vue";

export const useUserStore = defineStore("user", () => {
  interface User {
    id: number;
    name: string;
    telephone: string;
  }
  const user = ref<User>();

  const setUser = <T extends {id: number, name:string, telephone:string}>(userInfo: T) => {
    user.value = userInfo;
  };

  return { user, setUser };
});
