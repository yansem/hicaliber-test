import './bootstrap';

import { createApp } from 'vue'
import '../css/app.css'
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import App from './App.vue'

createApp(App)
    .use(ElementPlus)
    .mount("#app")