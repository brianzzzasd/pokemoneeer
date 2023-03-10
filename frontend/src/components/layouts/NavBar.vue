<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { useRouter } from 'vue-router'
import { storeToRefs } from 'pinia'
import { onMounted, ref } from 'vue'
import { useAuth } from '../../store/auth.js'

const store = useAuth()
const router = useRouter()
const { logout } = store
const { user } = storeToRefs(store)

onMounted(async () => {
  const { fetchUser } = store

  await fetchUser()
})

const onLogout = async () => {
  await logout()
  router.push('/login')
}
</script>

<template>
  <Disclosure
    v-slot="{ open }"
    as="nav"
    class="bg-white shadow"
  >
    <div
      v-if="user"
      class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8"
    >
      <div class="flex h-16 justify-between">
        <div class="flex px-2 lg:px-0">
          <div class="flex flex-shrink-0 items-center">
            <img
              class="block h-8 w-auto lg:hidden"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png"
              alt="Your Company"
            >
            <img
              class="hidden h-8 w-auto lg:block"
              src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png"
              alt="Your Company"
            >
          </div>
          <div class="hidden lg:ml-6 lg:flex lg:space-x-8">
            <router-link
              to="/"
              class="inline-flex items-center border-transparent border-b-2 px-1 pt-1 text-sm font-medium text-gray-900"
            >
              Pokemons
            </router-link>
            <router-link
              to="/users"
              class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            >
              Users
            </router-link>
          </div>
        </div>
        <div class="flex items-center lg:hidden">
          <!-- Mobile menu button -->
          <DisclosureButton class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon
              v-if="!open"
              class="block h-6 w-6"
              aria-hidden="true"
            />
            <XMarkIcon
              v-else
              class="block h-6 w-6"
              aria-hidden="true"
            />
          </DisclosureButton>
        </div>
        <div class="hidden lg:ml-4 lg:flex lg:items-center">
          <!-- Profile dropdown -->
          <Menu
            as="div"
            class="relative ml-4 flex-shrink-0"
          >
            <div>
              <MenuButton class="flex rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                <span class="sr-only">Open user menu</span>
                <img
                  class="h-8 w-8 rounded-full"
                  :src="user.avatar"
                  alt=""
                >
              </MenuButton>
            </div>
            <transition
              enter-active-class="transition ease-out duration-100"
              enter-from-class="transform opacity-0 scale-95"
              enter-to-class="transform opacity-100 scale-100"
              leave-active-class="transition ease-in duration-75"
              leave-from-class="transform opacity-100 scale-100"
              leave-to-class="transform opacity-0 scale-95"
            >
              <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <MenuItem>
                  <router-link
                    to="/profile"
                    class="block px-4 py-2 text-sm text-gray-700"
                  >
                    Your Profile
                  </router-link>
                </MenuItem>
                <MenuItem v-slot="{ active }">
                  <a
                    class="cursor-pointer block px-4 py-2 text-sm text-gray-700"
                    :class="[active ? 'bg-gray-100' : '']"
                    @click="onLogout"
                  >Sign out</a>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="lg:hidden">
      <div class="space-y-1 pt-2 pb-3 cursor-pointer">
        <DisclosureButton
          as="a"
          href="/"
          class="block border-l-4 border-indigo-500 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700"
        >
          Pokemons
        </DisclosureButton>
        <DisclosureButton
          as="a"
          href="/users"
          class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800"
        >
          Users
        </DisclosureButton>
      </div>
      <div class="border-t border-gray-200 pt-4 pb-3">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <img
              class="h-10 w-10 rounded-full"
              :src="user.avatar"
              alt=""
            >
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-gray-800">
              {{ user.name }}
            </div>
            <div class="text-sm font-medium text-gray-500">
              {{ user.email }}
            </div>
          </div>
        </div>
        <div class="mt-3 space-y-1 cursor-pointer">
          <DisclosureButton
            as="a"
            href="#"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
          >
            <router-link to="profile">
              Your Profile
            </router-link>
          </DisclosureButton>
          <DisclosureButton
            as="a"
            class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800"
            @click="onLogout"
          >
            Sign out
          </DisclosureButton>
        </div>
      </div>
    </DisclosurePanel>
  </Disclosure>
</template>

<style scoped>
.active {
  border-color: #2563eb;
  color: #2563eb;
}
</style>
