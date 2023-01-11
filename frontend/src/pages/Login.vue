<script setup>
import { ref } from 'vue'
import { storeToRefs } from 'pinia'
import Modal from '../components/molecules/Modal.vue'
import { useAuth } from '../store/auth.js'

const store = useAuth()

const { user } = storeToRefs(store)
const { login } = store

const email = ref('')
const password = ref('')

const open = ref(false)
const title = ref('')
const descriptions = ref([])
const buttonText = ref('OK')
const iconType = ref('danger')

const onSubmit = async () => {
  const response = await login(email.value, password.value)

  if (response.code === 'ok') {
    if (user.value && localStorage.getItem('token'))
      window.location.href = '/'
  }
  else {
    open.value = true
    title.value = 'Login Failed'
    descriptions.value = response.errors
  }

  setTimeout(() => {
    open.value = false
  }, 2000)
}
</script>

<template>
  <div class="flex h-screen">
    <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
      <div class="mx-auto w-full max-w-sm lg:w-96">
        <div>
          <img
            class="h-12 w-auto"
            src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png"
            alt="Your Company"
          >
          <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
            Sign in to your account
          </h2>
        </div>

        <div class="mt-8">
          <div class="mt-6">
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
                  required
                  class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm"
                >
              </div>
            </div>

            <div class="space-y-1 mt-5">
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
                  required
                  class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm"
                >
              </div>
            </div>
            <div class="mt-8">
              <button
                class="flex w-full justify-center rounded-md border border-transparent bg-orange-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                @click="onSubmit"
              >
                Sign in
              </button>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-end mt-4">
          <div class="text-sm">
            <a
              href="/register"
              class="font-medium text-gray-600 hover:text-gray-500"
            >No Account yet? Register here!</a>
          </div>
        </div>
      </div>
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
      <img
        class="absolute inset-0 h-full w-full object-cover"
        src="../assets/team-rocket.png"
        alt=""
      >
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
