import { createWebHistory, createRouter } from 'vue-router'

import HomeView from '@/components/HomeView.vue'
import ProductView from '@/components/ProductView.vue'
import OrderView from './components/OrderView.vue'


const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/product/:id',
        name: 'showProduct',
        component: ProductView,
        props: true
    },
    {
        path: '/order',
        name: 'order',
        component: OrderView
    }

]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})


export default router