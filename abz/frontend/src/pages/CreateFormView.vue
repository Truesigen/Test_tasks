<template>
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Form</h2>
            <form @submit.prevent="submitForm()" method="POST" enctype="multipart/form-data">

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input v-model="form.name" type="text" id="name" name="name"
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input v-model="form.email" type="text" id="email" name="email"
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="photo" class="block text-gray-700">Photo</label>
                    <input ref="file" @change="form.photo = $event.target.files[0]" type="file" name="photo"
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Phone</label>
                    <input v-model="form.phone" type="text" id="phone" name="phone"
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="position" class="block text-gray-700">Position</label>
                    <select v-model="form.position_id" id="position" name="position"
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Select your position</option>
                        <option v-for="position in positions" :key="position.id" :value="position.id">{{ position.name
                            }}</option>
                    </select>
                </div>
                <div class="text-red-500 m-2 py-2" v-if="errors">
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <div class="text-center">
                    <button type="submit" @submit.prevent="submitForm()"
                        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
                </div>

            </form>
        </div>

    </div>
</template>
<script setup>
import { ref, onMounted, reactive } from 'vue'
import axios from 'axios';

const positions = ref([])

onMounted(() => {
    axios.get('http://localhost/api/v1/positions').then(success => {
        positions.value = success.data.positions
    })
})

const errors = ref([])

const form = reactive({
    name: undefined,
    email: undefined,
    photo: undefined,
    phone: undefined,
    position_id: undefined
})

async function submitForm() {
    let formData = new FormData()

    errors.value = []

    for (let data in form) {
        if (form[data]) {
            formData.append(data, form[data])
        }
    }

    if (!localStorage.getItem('token')) {
        await axios.get('http://localhost/api/system/token/create').then(success => {
            localStorage.setItem('token', success.data.token)
        })
    }

    axios.post('http://localhost/api/v1/users', formData, { headers: { 'Authorization': localStorage.getItem('token') } }).then(success => {
        localStorage.removeItem('token')
    }).catch(error => {
        console.log(error)
        if (error.response.status == 409 || error.response.status == 401) {

            errors.value.push(error.response.data.message)
        } else if (error.response.status == 422) {
            errors.value = error.response.data.fails
        } else {
            errors.value[0] = 'Server is maintenance'
        }

    })

}




</script>
<style></style>