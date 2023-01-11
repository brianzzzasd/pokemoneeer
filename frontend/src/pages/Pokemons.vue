<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { ref } from 'vue'
import { storeToRefs } from 'pinia'
import { usePokemon } from '../store/pokemon.js'
import Modal from '../components/molecules/Modal.vue'

import TypeBadge from '../components/atoms/TypeBadge.vue'
import InfiniteLoading from '../components/organisims/InfiniteLoading.vue'

const store = usePokemon()

const page = ref(0)
const { pokemons } = storeToRefs(store)
const { fetchPokemons, addHate, addLike, addFavorite } = store

const open = ref(false)
const title = ref('')
const descriptions = ref([])
const buttonText = ref('OK')
const iconType = ref('')

const hate = async (id) => {
  open.value = true

  const response = await addHate(id)
  if (response.code === 'ok') {
    title.value = 'Success'
    descriptions.value = ['Added to hate list :(']
  }
  else {
    title.value = 'Error'
    descriptions.value = response.errors
    iconType.value = 'danger'
  }

  setTimeout(() => {
    open.value = false
    iconType.value = ''
  }, 2000)
}

const like = async (id) => {
  open.value = true

  const response = await addLike(id)
  if (response.code === 'ok') {
    title.value = 'Success'
    descriptions.value = ['Added to like list :)']
  }
  else {
    title.value = 'Error'
    descriptions.value = response.errors
    iconType.value = 'danger'
  }

  setTimeout(() => {
    open.value = false
    iconType.value = ''
  }, 2000)
}

const favorite = async (id) => {
  open.value = true

  const response = await addFavorite(id)
  if (response.code === 'ok') {
    title.value = 'Success'
    descriptions.value = ['Added to favorite list :)']
  }
  else {
    title.value = 'Error'
    descriptions.value = response.errors
    iconType.value = 'danger'
  }

  setTimeout(() => {
    open.value = false
    iconType.value = ''
  }, 2000)
}

const loadData = async ($state) => {
  $state.loading()
  try {
    const offset = pokemons.value.length
    const response = await fetchPokemons(offset)

    if (response.length < 20)
      $state.complete()
    else
      $state.loaded()
  }
  catch (error) {
    $state.error()
  }
}
</script>

<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">
          Pokemons
        </h1>
        <p class="mt-2 text-sm text-gray-700">
          List of Pokemons to chose from!
        </p>
      </div>
      <div class="flex flex-1 items-center justify-center px-2 lg:ml-6 lg:justify-end">
        <div class="w-full max-w-lg lg:max-w-xs">
          <label
            for="search"
            class="sr-only"
          >Search</label>
          <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <MagnifyingGlassIcon
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
              />
            </div>
            <input
              id="search"
              name="search"
              class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
              placeholder="Search"
              type="search"
            >
          </div>
        </div>
      </div>
    </div>
    <div class="mt-2 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div
            id="pokes"
            class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
          >
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50 fixed">
                <tr>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                  >
                    Name
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                  >
                    Types
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                  >
                    Actions
                  </th>
                  <th
                    scope="col"
                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                  >
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr
                  v-for="pokemon in pokemons"
                  :key="pokemon.email"
                >
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                    <div class="flex items-center">
                      <div class="h-10 w-10 flex-shrink-0">
                        <img
                          class="h-10 w-10 rounded-full"
                          :src="pokemon.sprite"
                          alt=""
                        >
                      </div>
                      <div class="ml-4">
                        <div class="font-medium text-gray-900">
                          {{ pokemon.name }}
                        </div>
                        <div class="text-gray-500">
                          {{ pokemon.email }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="flex">
                      <div
                        v-for="pokeType in JSON.parse(pokemon.types)"
                        :key="pokeType"
                        class="mr-2"
                      >
                        <TypeBadge :type="pokeType" />
                      </div>
                    </div>
                  </td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">
                    <div class="flex">
                      <div
                        class="mr-4 cursor-pointer"
                        @click="hate(pokemon.id)"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          class="w-8 h-8 hate-icon"
                        >
                          <path d="M15.73 5.25h1.035A7.465 7.465 0 0118 9.375a7.465 7.465 0 01-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 01-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 00-.322 1.672V21a.75.75 0 01-.75.75 2.25 2.25 0 01-2.25-2.25c0-1.152.26-2.243.723-3.218C7.74 15.724 7.366 15 6.748 15H3.622c-1.026 0-1.945-.694-2.054-1.715A12.134 12.134 0 011.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77a4.5 4.5 0 011.423.23l3.114 1.04a4.5 4.5 0 001.423.23zM21.669 13.773c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.959 8.959 0 01-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227z" />
                        </svg>
                      </div>
                      <div
                        class="mr-4 cursor-pointer"
                        @click="like(pokemon.id)"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="skyblue"
                          class="w-8 h-8 like-icon"
                        >
                          <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
                        </svg>
                      </div>
                      <div
                        class="mr-4 cursor-pointer"
                        @click="favorite(pokemon.id)"
                      >
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 24 24"
                          fill="yellow"
                          class="w-8 h-8 favorite-icon"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd"
                          />
                        </svg>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
              <InfiniteLoading @infinite="loadData" />
            </table>
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

<style scoped>
.fixed {
  top: 0;
  z-index: 2;
  position: sticky;
  background-color: white;
}

#pokes {
  display: block;
  max-height: 600px;
  overflow-y: scroll;
}

.hate-icon {
  fill: #F08030;
}

.hate-icon:hover {
  fill: #F96141;
}

.like-icon {
  fill: #98D8D8;
}

.like-icon:hover {
  fill: #8EE8F0;
}

.favorite-icon {
  fill: #F8D030;
}

.favorite-icon:hover {
  fill: #F4DA6C;
}
</style>
