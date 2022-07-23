import { createRouter, createWebHashHistory } from "vue-router";

import NProgress from "nprogress/nprogress.js";

// Main layouts
import LayoutBackend from "@/scripts/layouts/variations/BackendStarter.vue";
import LayoutSimple from "@/scripts/layouts/variations/Simple.vue";

import { useUserStore } from "@/scripts/stores/user";

// Frontend: Landing
const Landing = () => import("@/scripts/views/workana/LandingView.vue");

// Backend: Dashboard
const Dashboard = () => import("@/scripts/views/workana/DashboardView.vue");

const CashRegisterIndex = () => import("@/scripts/views/workana/cash-register/CashRegisterIndex.vue");
const CashRegisterAdd = () => import("@/scripts/views/workana/cash-register/CashRegisterAdd.vue");
const CashRegisterEdit = () => import("@/scripts/views/workana/cash-register/CashRegisterEdit.vue");

const ProductIndex = () => import("@/scripts/views/workana/product/ProductIndex.vue");
const ProductAdd = () => import("@/scripts/views/workana/product/ProductAdd.vue");
const ProductEdit = () => import("@/scripts/views/workana/product/ProductEdit.vue");

const UserIndex = () => import("@/scripts/views/workana/user/UserIndex.vue");
const UserAdd = () => import("@/scripts/views/workana/user/UserAdd.vue");
const UserEdit = () => import("@/scripts/views/workana/user/UserEdit.vue");

const MovementIndex = () => import("@/scripts/views/workana/movement/MovementIndex.vue");
const AuthSignIn = () => import("@/scripts/views/workana/LoginView.vue");

const requireAuth = async (to, from, next) => {
  const userStore = useUserStore();
  const user = JSON.parse(localStorage.getItem("user"));

  if (user) {
    userStore.loggedIn = true;
    next();
  } else {
    userStore.loggedIn = false;
    next("/login");
  }
};

// Set all routes
const routes = [
  {
    path: "/login",
    component: LayoutSimple,
    children: [
      {
        path: "",
        name: "login",
        component: AuthSignIn,
      },
    ],
  },
  {
    path: "/",
    component: LayoutSimple,
    children: [
      {
        path: "",
        name: "landing",
        component: Landing,
        beforeEnter: requireAuth
      },
    ],
  },
  {
    path: "/backend",
    redirect: "/backend/dashboard",
    component: LayoutBackend,
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: Dashboard,
        beforeEnter: requireAuth
      },
      {
        path: "cash-register",
        name: "cash-register",
        component: CashRegisterIndex,
        beforeEnter: requireAuth
      },
      {
        path: "cash-register/add",
        name: "cash-register.add",
        component: CashRegisterAdd,
        beforeEnter: requireAuth
      },
      {
        path: "cash-register/:id/edit",
        name: "cash-register.edit",
        component: CashRegisterEdit,
        beforeEnter: requireAuth
      },
      {
        path: "product",
        name: "product",
        component: ProductIndex,
        beforeEnter: requireAuth
      },
      {
        path: "product/add",
        name: "product.add",
        component: ProductAdd,
        beforeEnter: requireAuth
      },
      {
        path: "product/:id/edit",
        name: "product.edit",
        component: ProductEdit,
        beforeEnter: requireAuth
      },
      {
        path: "user",
        name: "user",
        component: UserIndex,
        beforeEnter: requireAuth
      },
      {
        path: "user/add",
        name: "user.add",
        component: UserAdd,
        beforeEnter: requireAuth
      },
      {
        path: "user/:id/edit",
        name: "user.edit",
        component: UserEdit,
        beforeEnter: requireAuth
      },
      {
        path: "movement",
        name: "movement",
        component: MovementIndex,
        beforeEnter: requireAuth
      },
    ],
  }
];

// Create Router
const router = createRouter({
  history: createWebHashHistory(),
  linkActiveClass: "active",
  linkExactActiveClass: "active",
  scrollBehavior() {
    return { left: 0, top: 0 };
  },
  routes,
});

// NProgress
/*eslint-disable no-unused-vars*/
NProgress.configure({ showSpinner: false });

router.beforeResolve((to, from, next) => {
  NProgress.start();
  next();
});

router.afterEach((to, from) => {
  NProgress.done();
});
/*eslint-enable no-unused-vars*/

export default router;
