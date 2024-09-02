import { createApp } from 'vue'
import { createPinia } from 'pinia'
import './style.css'
import App from './App.vue'
import router from './router'


import PrimeVue from 'primevue/config'
import Aura from '@/presets/Aura'

createApp(App)
    .use(router)
    .use(PrimeVue, { unstyled: true, pt: Aura })
    .use(createPinia())
    .mount('#app')
