import { defineStore } from "pinia";
import api from "@/scripts/services/api";
import { Toast } from "@/scripts/mixins/toast";

export const useUserStore = defineStore("userStore", {
  id: "auth",
  state: () => ({
    // initialize state from local storage to enable user to stay logged in
    loggedIn: false,
    user: JSON.parse(localStorage.getItem("user")),
    permissions: localStorage.getItem("permissions"),
    token: localStorage.getItem("token"),
  }),
  actions: {
    async login(email, password) {
      try {
        const { data } = await api.post(`/login`, {
          email,
          password,
        });

        Toast.fire({
          icon: "success",
          title: data.message,
        });

        // update pinia state
        this.user = data.data.user;
        this.permissions = data.data.permissions;
        this.token = data.data.token;
        this.loggedIn = true;

        // store user details and jwt in local storage to keep user logged in between page refreshes
        localStorage.setItem("permissions", this.permissions);
        localStorage.setItem("token", this.token);
        localStorage.setItem("user", JSON.stringify(this.user));

        return 200;
      } catch (error) {
        Toast.fire({
          icon: "error",
          title: error.response.data.message,
        });
        return 404;
      }
    },
    logout() {
      this.user = null;
      localStorage.clear();
    },
  },
});
