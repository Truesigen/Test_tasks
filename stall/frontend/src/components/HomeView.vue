<template>
    <div class="h-screen w-full">
        <MegaMenu :model="items" orientation="horizontal" />
        <CascadeSelect @change="handleFilter()" v-model="selectedFilter" :options="filterOprions" optionLabel="name"
            optionGroupLabel="name" :optionGroupChildren="'states'" style="min-width: 14rem"
            placeholder="Select filter" />
        <div class="grid grid-cols-3 gap-3 p-32 place-items-center">
            <Card style="width: 20rem; overflow: hidden;" v-for="product in products" :key="product.id">
                <template #header>
                    <img alt="user header" :src="'http://localhost/storage/products/' + product.image" />
                </template>
                <template #title>{{ product.name }}</template>
                <template #subtitle>{{ '$' + product.price }}</template>
                <template #footer>
                    <div class="flex gap-3 mt-1">
                        <Button label="View" severity="secondary" outlined class="w-full"
                            @click="$router.push({ name: 'showProduct', params: { id: product.id } })" />
                        <Button label="Add to cart" class="w-full" @click.prevent="cart.addItem(product)" />
                    </div>
                </template>
            </Card>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import Card from 'primevue/card'
import Button from 'primevue/button'
import MegaMenu from 'primevue/megamenu'
import CascadeSelect from 'primevue/cascadeselect'


import { useCartStore } from '@/store/cart'

const products = ref([])
const cart = useCartStore()
const selectedFilter = ref();

onMounted(() => {
    axios.get('http://localhost/api/products').then(success => {
        products.value = success.data.products.data

    })
})

function getProductByCategory(category) {
    axios.get(`http://localhost/api/products/${category}/show`).then(success => {
        products.value = success.data.products
    })
}

function handleFilter() {
    switch (selectedFilter.value.name) {
        case 'low to high':
            products.value.sort((a, b) => {
                return a.price - b.price
            })
            break
        case 'high to low':
            products.value.sort((a, b) => {
                return b.price - a.price
            })
            break
        case 'old':
            products.value.sort((a, b) => {
                return new Date(a.created_at).getTime() - new Date(b.created_at).getTime()
            })
            break
        case 'new':
            products.value.sort((a, b) => {
                return new Date(b.created_at).getTime() - new Date(a.created_at).getTime()
            })
            break
        default: break
    }

}

const items = ref([
    {
        label: 'Millitary',
        items: [
            [
                {
                    items: [{ label: 'Weapons', command: () => { getProductByCategory('Weapons') } }, { label: 'Helmets', command: () => { getProductByCategory('Helmets') } }]
                }
            ],

        ]
    },
    {
        label: 'Electronics',
        items: [
            [
                {
                    items: [{ label: 'Sound Cards', command: () => { getProductByCategory('Sound Cards') } }, { label: 'Others', command: () => { getProductByCategory('Others') } }]
                }
            ],

        ]
    },
    {
        label: 'Furniture',
        items: [
            [
                {
                    items: [{ label: 'Mugs', command: () => { getProductByCategory('Mugs') } }, { label: 'Kitchen Appliances', command: () => { getProductByCategory('Kitchen Appliances') } }]
                }
            ],

        ]
    }
]);

const filterOprions = ref([
    {
        name: 'Price',
        states: [
            {
                name: 'low to high',
            },
            {
                name: 'high to low',

            }
        ]
    },
    {
        name: 'Date',
        states: [
            {
                name: 'new',

            },
            {
                name: 'old',

            }
        ]
    }
])
</script>
<style></style>