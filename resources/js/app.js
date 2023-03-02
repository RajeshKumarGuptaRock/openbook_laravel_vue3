import './bootstrap';
import { createApp } from 'vue'
import app from './layouts/app.vue'

import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'

createApp(app).use(bootstrap).mount("#app")