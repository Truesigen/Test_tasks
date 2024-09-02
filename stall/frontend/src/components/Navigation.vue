<template>
    <div>
        <nav id="header" class="w-full z-30 top-0 bg-white shadow-lg border-b border-blue-400">
            <div class="w-full flex items-center justify-between mt-0 px-6 py-2">
                <label for="menu-toggle" class="cursor-pointer md:hidden block">
                    <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                        viewBox="0 0 20 20">
                        <title>menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </label>
                <input class="hidden" type="checkbox" id="menu-toggle">

                <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                    <nav>
                        <ul class="md:flex items-center justify-between text-base text-blue-600 pt-4 md:pt-0">
                            <li><a @click="$router.push('/')"
                                    class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2"
                                    href="#">Home</a></li>
                        </ul>

                    </nav>
                </div>

                <div class="order-2 md:order-3 flex flex-wrap items-center justify-end mr-0 md:mr-4" id="nav-content">
                    <div class="flex justify-center items-center">
                        <div class="relative py-2 cursor-pointer" @click.prevent="cartVisible = true">
                            <div class="t-0 absolute left-3">
                                <p
                                    class="flex h-2 w-2 items-center justify-center rounded-full bg-red-500 p-3 text-xs text-white">
                                    {{ cart.itemCount }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="file: mt-4 h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div>
        </div>
        <Dialog v-model:visible="cartVisible" modal header="Manage Carts" :style="{ width: '50vw' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }" class="bg-white">
            <div class="flex h-full flex-col justify-center">
                <div class="overflow-x-auto p-3">
                    <table class="w-full table-auto">
                        <thead class="bg-gray-50 text-xs font-semibold uppercase text-gray-400">
                            <tr>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Product Name</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Quantity</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-left font-semibold">Total</div>
                                </th>
                                <th class="p-2">
                                    <div class="text-center font-semibold">Action</div>
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 text-sm">
                            <!-- record 1 -->
                            <tr v-for="item in cart.items" :key="item.id">
                                <td class="p-2">
                                    <div class="font-medium text-gray-800">{{ item.name }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left">1</div>
                                </td>
                                <td class="p-2">
                                    <div class="text-left font-medium text-green-500">{{ item.price }}</div>
                                </td>
                                <td class="p-2">
                                    <div class="flex justify-center">
                                        <button @click.prevent="cart.removeItem(item)">
                                            <svg class="h-8 w-8 rounded-full p-1 hover:bg-gray-100 hover:text-blue-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end space-x-4 border-t border-gray-100 px-5 py-4 text-2xl font-bold">
                    <div>Total</div>
                    <div class="text-blue-600">{{ cart.items.reduce((acc, cur) => {
                        return parseInt(acc) + parseInt(cur.price)
                    }, 0) }}</div>
                </div>
            </div>
            <button @click.prevent="cartVisible = false, $router.push('/order')"
                class="flex justify-center w-full p-3 rounded-lg bg-black text-white">Order</button>
        </Dialog>
    </div>
</template>
<script setup>
import { ref } from 'vue'

import Dialog from 'primevue/dialog'
import { useCartStore } from '@/store/cart'

const cart = useCartStore()
const cartVisible = ref(false)


</script>
<style></style>