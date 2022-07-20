import { createApp } from 'vue'
import App from './App.vue'
import router from "./router"

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'

/* import api from "./services/api"
window.api = api */

const app = createApp(App)
library.add(fas, fab, far)
app.component("font-awesome-icon", FontAwesomeIcon)
app.use(router)
app.use(VueSweetalert2)
app.mount('#app')
