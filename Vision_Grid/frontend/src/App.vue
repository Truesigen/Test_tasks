<template>
  <div style="max-width: 400px; margin: 2rem auto; font-family: sans-serif;">
    <h2>Parcel Price Calculator</h2>

    <div style="margin-bottom: 1rem;">
      <label>Weight (kg):</label>
      <input type="number" v-model.number="form.weight" min="0" step="0.01" />
    </div>

    <div style="margin-bottom: 1rem;">
      <label>Carrier:</label>
      <select v-model="form.carrier">
        <option value="" disabled>Select carrier</option>
        <option v-for="(carrier, index) in carriers" :key="index" :value="carrier">{{ carrier }}</option>
      </select>
    </div>

    <button @click.prevent="calculatePrice">
      Calculate price
    </button>

    <div v-if="result" class="result-card">
      <h4>Details:</h4>
      <div class="price-main">
        {{ result.price }} {{ result.currency }}
      </div>
      <div class="details">
        <p><strong>Carrier:</strong> {{ result.carrier }}</p>
        <p><strong>Weight:</strong> {{ result.weight }} кг</p>
      </div>
    </div>
    <div style="margin-top: 1rem; color: red;" v-if="error">{{ error }}</div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const carriers = ref([])

const form = ref({
  weight: 0,
  carrier: ''
})

const result = ref('')
const error = ref('')

onMounted(async () => {
  await getCarriers()
})

async function getCarriers() {

  let request = await fetch('http://localhost/api/carriers', {
    headers: {
      'Accept': 'application/json'
    }
  })
  if (!request.ok) throw new Error('Failed to fetch carriers')
  let data = await request.json()
  carriers.value = data

}

async function calculatePrice() {

  let request = await fetch('http://localhost/api/shipping/calculate', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify(form.value)
  })

  if (!request.ok) {
    let data = await request.json()
    error.value = `${data['errors']['field']}: ${data['errors']['message']}`
    return
  }

  result.value = await request.json()
}
</script>

<style>
.result-card {
  margin-top: 15px;
  padding: 10px;
  background-color: #f0fdf4;
  border: 1px solid #bbf7d0;
  border-radius: 8px;
  color: #166534;
}

.price-main {
  font-size: 24px;
  font-weight: bold;
  margin: 10px 0;
}

.details p {
  margin: 5px 0;
  font-size: 14px;
  color: #374151;
}
</style>