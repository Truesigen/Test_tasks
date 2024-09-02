<template>
    <!-- component -->
    <div class="bg-white p-8 rounded-md w-full">
        <div class=" flex items-center justify-between pb-6">
            <div>
                <h2 class="text-gray-600 font-semibold">Users list</h2>

            </div>
            <div class="flex items-center justify-between">
                <div class="lg:ml-40 ml-10 space-x-8">
                    <button @click.prevent="$router.push('/user/create')"
                        class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Create</button>
                </div>
            </div>
        </div>
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    №
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    email
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    phone
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    position
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users.users" :key="user.id">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ user.id }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <img class="w-full h-full rounded-full" :src="user.photo" alt="" />
                                        </div>
                                        <div class="ml-3"
                                            @click.prevent="$router.push({ name: 'show-user', params: { id: user.id } })">
                                            <p class="text-gray-900 underline decoration-sky-500 cursor-pointer">
                                                {{ user.name }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ user.phone }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ user.position }}
                                    </p>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <Paginator :rows="6" :totalRecords="users.total_users" @page="updateUsersPage($event.page + 1)">
                        </Paginator>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button @click.prevent="showMore()"
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                Show more
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import Paginator from 'primevue/paginator'
import axios from 'axios'

const users = ref({})


onMounted(() => {
    axios.get('http://localhost/api/v1/users?page=1&count=6').then(success => {
        users.value = success.data
        console.log(success)
    })
})

function updateUsersPage(page) {
    axios.get(`http://localhost/api/v1/users?page=${page}&count=6`).then(success => {
        users.value = success.data

    })
}

function showMore() {
    if (users.value.links.next_url) {

        axios.get(users.value.links.next_url).then(success => {
            users.value.links = success.data.links
            users.value.users.push(...success.data.users)
        })
    }
}
</script>
<style></style>