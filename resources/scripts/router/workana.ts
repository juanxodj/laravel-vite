import { createRouter, createWebHashHistory } from "vue-router";

import NProgress from "nprogress/nprogress.js";

// Main layouts
import LayoutBackend from "@/scripts/layouts/variations/BackendStarter.vue";
import LayoutSimple from "@/scripts/layouts/variations/Simple.vue";

// Frontend: Landing
const Landing = () => import("@/scripts/views/workana/LandingView.vue");

// Backend: Dashboard
const Dashboard = () => import("@/scripts/views/workana/DashboardView.vue");

const CashRegister = () => import("@/scripts/views/workana/CashRegisterView.vue");
const Movement = () => import("@/scripts/views/workana/MovementView.vue");
const Product = () => import("@/scripts/views/workana/ProductView.vue");
const User = () => import("@/scripts/views/workana/UserView.vue");

// Set all routes
const routes = [
  {
    path: "/",
    component: LayoutSimple,
    children: [
      {
        path: "",
        name: "landing",
        component: Landing,
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
        name: "backend-dashboard",
        component: Dashboard,
      },
      {
        path: "cash-register",
        name: "cash-register",
        component: CashRegister,
      },
      {
        path: "movement",
        name: "movement",
        component: Movement,
      },
      {
        path: "product",
        name: "product",
        component: Product,
      },
      {
        path: "user",
        name: "user",
        component: User,
      },
    ],
  },
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
