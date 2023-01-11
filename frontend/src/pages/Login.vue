<script setup>
import { ref } from 'vue'
import { useAuth } from '../store/auth.js'
import { storeToRefs } from "pinia"
import { useRouter } from 'vue-router'

const router = useRouter()
const store = useAuth()

const { user } = storeToRefs(store)
const { login, logout, requestCookie } = store

const email = ref('')
const password = ref('')

const loginForm = ref(null)

const onSubmit = async () => {
  await login(email.value, password.value)

  if (user.value) {
    router.push({ name: 'Pokemons' })
  }
}
</script>
<template>
<div class="flex h-screen">
  <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
    <div class="mx-auto w-full max-w-sm lg:w-96">
      <div>
        <img class="h-12 w-auto" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png" alt="Your Company">
        <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>

      </div>

      <div class="mt-8">
        <div class="mt-6">
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
              <div class="mt-1">
                <input v-model="email" id="email" name="email" type="email" autocomplete="email" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm">
              </div>
            </div>

            <div class="space-y-1 mt-5">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <div class="mt-1">
                <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-orange-500 focus:outline-none focus:ring-orange-500 sm:text-sm">
              </div>
            </div>
            <div class="mt-8">
              <button @click="onSubmit" class="flex w-full justify-center rounded-md border border-transparent bg-orange-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2">Sign in</button>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="relative hidden w-0 flex-1 lg:block">
    <img class="absolute inset-0 h-full w-full object-cover" src="../assets/team-rocket.png" alt="">
  </div>
</div>
</template>
