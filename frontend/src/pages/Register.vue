<script setup>
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import Modal from '../components/molecules/Modal.vue'
import { useAuth } from '../store/auth.js'

const router = useRouter()
const store = useAuth()
const { register } = store

const open = ref(false)
const title = ref('')
const descriptions = ref([])
const buttonText = ref('OK')
const iconType = ref('')

const name = ref('')
const email = ref('')
const password = ref('')

const onSubmit = async () => {
  const response = await register({
    name: name.value,
    email: email.value,
    password: password.value,
  })

  if (response.code === 'ok') {
    window.location.href = '/'
  }
  else {
    open.value = true
    title.value = 'Error'
    descriptions.value = response.errors
    iconType.value = 'danger'
  }

  setTimeout(() => {
    open.value = false
  }, 2000)
}
</script>

<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png"
        alt="Your Company"
      >
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
        Register an account!
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div class="space-y-6">
          <div>
            <label
              for="name"
              class="block text-sm font-medium text-gray-700"
            >Name</label>
            <div class="mt-1">
              <input
                id="name"
                v-model="name"
                name="name"
                type="name"
                autocomplete="name"
                required="true"
                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm"
              >
            </div>
          </div>
          <div>
            <label
              for="email"
              class="block text-sm font-medium text-gray-700"
            >Email address</label>
            <div class="mt-1">
              <input
                id="email"
                v-model="email"
                name="email"
                type="email"
                autocomplete="email"
                required="true"
                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm"
              >
            </div>
          </div>

          <div>
            <label
              for="password"
              class="block text-sm font-medium text-gray-700"
            >Password</label>
            <div class="mt-1">
              <input
                id="password"
                v-model="password"
                name="password"
                type="password"
                autocomplete="current-password"
                required="true"
                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm"
              >
            </div>
          </div>
          <div>
            <button
              class="flex w-full justify-center rounded-md border border-transparent bg-orange-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
              @click="onSubmit"
            >
              Register
            </button>
          </div>
        </div>
      </div>
    </div>
    <Modal
      :open="open"
      :title="title"
      :descriptions="descriptions"
      :button-text="buttonText"
      :icon-type="iconType"
    />
  </div>
</template>
