import { createApp } from 'vue'
import { createPinia } from "pinia"
import App from '@/scripts/App.vue'

// You can use the following starter router instead of the default one as a clean starting point
// import router from "./router/starter";
import router from "@/scripts/router/workana"

// Template components
import BaseBlock from "@/scripts/components/BaseBlock.vue";
import BaseBackground from "@/scripts/components/BaseBackground.vue";
import BasePageHeading from "@/scripts/components/BasePageHeading.vue";

// Template directives
import clickRipple from "@/scripts/directives/clickRipple";

// Bootstrap framework
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

// Craft new application
const app = createApp(App)

// Register global components
app.component("BaseBlock", BaseBlock);
app.component("BaseBackground", BaseBackground);
app.component("BasePageHeading", BasePageHeading);

// Register global directives
app.directive("click-ripple", clickRipple);

// Use Pinia and Vue Router
app.use(createPinia());
app.use(router);

// ..and finally mount it!
app.mount('#app')
