import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "vite-plugin-laravel";
import AutoImport from "unplugin-auto-import/vite";

export default defineConfig({
  plugins: [
    vue(),
    laravel(),
    AutoImport({
      imports: ["vue", "vue-router"],
      dts: "resources/scripts/auto-imports.d.ts",
      vueTemplate: true,
    }),
  ],
});
