import { defineConfig } from "vite";
import Vue from "@vitejs/plugin-vue";
import Laravel from "vite-plugin-laravel";
import AutoImport from "unplugin-auto-import/vite";

export default defineConfig({
  plugins: [
    Vue(),
    Laravel(),
    AutoImport({
      imports: ["vue", "vue-router"],
      dts: "resources/scripts/auto-imports.d.ts",
      vueTemplate: true,
    }),
  ],
});
