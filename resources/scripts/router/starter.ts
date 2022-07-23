import { createRouter, createWebHashHistory } from "vue-router";

import NProgress from "nprogress/nprogress.js";

// Main layouts
import LayoutBackend from "@/scripts/layouts/variations/BackendStarter.vue";
import LayoutSimple from "@/scripts/layouts/variations/Simple.vue";

// Frontend: Landing
const Landing = () => import("@/scripts/views/starter/LandingView.vue");

// Backend: Dashboard
const Dashboard = () => import("@/scripts/views/starter/DashboardView.vue");

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
        name: "dashboard",
        component: Dashboard,
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
