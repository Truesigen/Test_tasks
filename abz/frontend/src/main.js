import { createApp } from 'vue'
import App from './App.vue'
import './style.css'

import router from './router'
import PrimeVue from 'primevue/config'
import Aura from './presets/Aura'

createApp(App)
    .use(router)
    .use(PrimeVue, {
        unstyled: true,
        pt: Aura
    })
    .mount('#app')
