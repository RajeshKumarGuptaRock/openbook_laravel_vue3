import './bootstrap';
import { createApp } from 'vue'
import app from './layouts/app.vue'
import router from './router.js'
import 'bootstrap/dist/css/bootstrap.css'
import bootstrap from 'bootstrap/dist/js/bootstrap.bundle.js'
import store from './store/index.js'

createApp(app).use(bootstrap).use(router).use(store).mount("#app")