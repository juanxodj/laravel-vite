import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"

const routes: Array<RouteRecordRaw> = [
  {
    path: "/",
    component: () => import("./../layout/MainLayout.vue"),
    children: [
      {
        path: "",
        name: "test",
        component: () => import("./../components/Test.vue"),
      },
      {
        path: "hello-world",
        name: "hello-world",
        component: () => import("./../components/HelloWorld.vue"),
      },
      {
        path: "table",
        name: "table",
        component: () => import("./../components/Table.vue"),
      },
      {
        path: "table/:id/edit",
        name: "table.edit",
        component: () => import("./../components/TableEdit.vue"),
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
