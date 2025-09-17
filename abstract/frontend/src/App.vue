<template>
  <div>
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in data" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
        </tr>
      </tbody>
    </table>
    <div v-if="errors && errors.length">
      <small style="color: red;" v-for="(error, i) in errors" :key="i">{{ error }}</small>
    </div>
    <div>
      <input type="text" v-model="inputData.name" placeholder="name" />
      <input type="text" v-model="inputData.email" placeholder="email" />
      <button type="submit" @click.prevent="addUser()">add user</button>
    </div>
  </div>
  <div v-if="!authorization">
    <button style="width: 100%;" type="submit" @click.prevent="login()">Authorization</button>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

const authorization = ref(false)

const data = ref({})

const errors = ref([])

const inputData = reactive({
  name: '',
  email: ''
})

function addUser() {
  errors.value = []

  let token = localStorage.getItem('token')
  axios.post('http://localhost:8000/api/info', inputData, { headers: { 'Authorization': `Bearer ${token}` } })
    .then(success => getUsers())
    .catch(error => {
      errors.value.push(error.response.data.error ?? error.response.data.message)
    })
}

function getUsers() {
  axios.get('http://localhost:8000/api/info', { headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` } }).then(success => data.value = success.data.users)
}

function login() {
  errors.value = []
  axios.post('http://localhost:8000/api/login', { name: 'admin', email: 'root@admin.com', password: 'admin' })
    .then(success => {
      localStorage.setItem('token', success.data.token)
      authorization.value = true
      getUsers()
    })

}

onMounted(() => {
  if (localStorage.getItem('token')) {
    authorization.value = true
    getUsers()
  }
})

</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 50%;
  margin: 20px auto;
}
</style>
