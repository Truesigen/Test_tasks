import { createWebHistory, createRouter } from 'vue-router'

import HomeView from '@/pages/HomeView.vue'
import UserView from '@/pages/UserView.vue'
import CreateFormView from '@/pages/CreateFormView.vue'



const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/user/:id',
        name: 'show-user',
        component: UserView,
        props: true
    },
    {
        path: '/user/create',
        name: 'create-user',
        component: CreateFormView
    }

]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
})


export default router