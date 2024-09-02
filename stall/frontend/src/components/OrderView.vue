<template>
    <div class="h-screen flex items-start justify-center bg-gray-100 pt-32">
        <div class="w-full max-w-md p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-semibold text-center mb-6">Fill the form</h1>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="name" class="text-sm font-medium text-gray-700">Name</label>
                    <InputText id="name" v-model="input.name" :invalid="error.name" aria-describedby="name-help"
                        placeholder="Name"
                        class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <small id="name-help" class="text-red-500" v-if="error.name">Enter your name.
                        Required.</small>
                </div>
                <div class="flex flex-col">
                    <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                    <InputText id="email" v-model="input.email" :invalid="error.email" aria-describedby="email-help"
                        placeholder="Email"
                        class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <small id="email-help" class="text-red-500" v-if="error.email">Enter your email.
                        Required.</small>
                </div>
                <div class="flex flex-col">
                    <label for="phone" class="text-sm font-medium text-gray-700">Phone</label>
                    <InputText id="phone" v-model="input.phone" :invalid="error.phone" aria-describedby="phone-help"
                        placeholder="Phone"
                        class="p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <small id="phone-help" class="text-red-500" v-if="error.phone">Enter your phone.
                        Required.</small>
                </div>
                <button @click.prevent="handleOrder()"
                    class="mt-4 p-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Order
                </button>
            </div>
        </div>
    </div>

</template>
<script setup>
import { ref, reactive } from 'vue'
import InputText from 'primevue/inputtext'
import { useCartStore } from '@/store/cart';
import axios from 'axios'

const input = reactive({
    name: '',
    email: '',
    phone: ''
})

const error = ref({})
const cart = useCartStore()

function handleOrder() {
    if (cart.items.length == 0) {
        alert('cart is empty!')
        return
    }

    validation(input)

    if (Object.keys(error.value).length > 0) {
        return
    }

    axios.post('http://localhost/api/orders', { name: input.name, email: input.email, phone: input.phone, products: cart.items }).then(success => {
        alert(success.data.message)
        cart.clearCart()
    }).catch(error => {
        alert(error)

    })

}

function validation(input) {

    error.value = {}

    Object.keys(input).forEach(key => {
        if (input[key] == '') {
            error.value[key] = true
        }
    })
}

</script>
<style></style>