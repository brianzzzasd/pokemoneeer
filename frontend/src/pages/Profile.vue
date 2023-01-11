<script setup>
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useAuth } from '../store/auth.js'
import Modal from '../components/molecules/Modal.vue'

const router = useRouter()
const store = useAuth()
const { updateUser } = store
const { user } = storeToRefs(store)

const password = ref('')

const open = ref(false)
const title = ref('')
const descriptions = ref([])
const buttonText = ref('OK')
const iconType = ref('')

const onSubmit = async () => {
  const response = await updateUser({
    name: store.user.name,
    email: store.user.email,
    password: password.value,
  })

  if (response.code === 'ok') {
    open.value = true
    title.value = 'Success'
    descriptions.value = ['Your account has been updated.']
  }
  else {
    open.value = true
    title.value = 'Error'
    descriptions.value = response.errors
    iconType.value = 'danger'
  }

  setTimeout(() => {
    open.value = false
    iconType.value = ''
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
        Account Details
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <div
          v-if="user"
          class="space-y-6"
        >
          <div>
            <label
              for="name"
              class="block text-sm font-medium text-gray-700"
            >Name</label>
            <div class="mt-1">
              <input
                id="name"
                v-model="user.name"
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
                v-model="user.email"
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
              Update
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
