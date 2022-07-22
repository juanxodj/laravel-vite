import { createApp } from 'vue'
import { createPinia } from "pinia"
import App from '@/scripts/App.vue'

import router from "@/scripts/router"

// Template components
import BaseBlock from "@/scripts/components/BaseBlock.vue";
import BaseBackground from "@/scripts/components/BaseBackground.vue";
import BasePageHeading from "@/scripts/components/BasePageHeading.vue";

// Template directives
import clickRipple from "@/scripts/directives/clickRipple";

// Bootstrap framework
import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

/* import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css' */

const app = createApp(App)

// Register global components
app.component("BaseBlock", BaseBlock);
app.component("BaseBackground", BaseBackground);
app.component("BasePageHeading", BasePageHeading);

// Register global directives
app.directive("click-ripple", clickRipple);

/* library.add(fas, fab, far)
app.component("font-awesome-icon", FontAwesomeIcon)
app.use(VueSweetalert2) */

app.use(router)
app.use(createPinia())
app.mount('#app')
