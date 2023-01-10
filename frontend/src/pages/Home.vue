<script setup>
import { ref } from 'vue';
import { usePokemon } from '../store/pokemon.js'
import { storeToRefs } from "pinia";

import TypeBadge from '../components/atoms/TypeBadge.vue'
import InfiniteLoading from '../components/organisims/InfiniteLoading.vue'

const store = usePokemon();

const page = ref(0);
const { pokemons } = storeToRefs(store);
const { fetchPokemons } = store;

const loadData = async $state => {
  $state.loading()
  try {
    const offset = pokemons.value.length
    console.log(offset)
    const response = await fetchPokemons(offset)

    if (response.length < 20)
      $state.complete();
    else
      $state.loaded();

  } catch (error) {
    $state.error()
  }
}

</script>

<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Pokemons</h1>
        <p class="mt-2 text-sm text-gray-700">List of Pokemons to chose from!</p>
      </div>
    </div>
    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div id="pokes" class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50 fixed">
                <tr>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Types</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="pokemon in pokemons" :key="pokemon.email">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                    <div class="flex items-center">
                      <div class="h-10 w-10 flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="pokemon.sprite" alt="" />
                      </div>
                      <div class="ml-4">
                        <div class="font-medium text-gray-900">{{ pokemon.name }}</div>
                        <div class="text-gray-500">{{ pokemon.email }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div class="flex">
                      <div class="mr-2" v-for="pokeType in JSON.parse(pokemon.types)">
                        <TypeBadge :type="pokeType"></TypeBadge>
                      </div>
                    </div>
                  </td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-left text-sm font-medium sm:pr-6">
                    <a href="#" class="pr-2 text-indigo-600 hover:text-indigo-900"
                      >Favorite</a>
                    <a href="#" class="pr-2 text-indigo-600 hover:text-indigo-900"
                      >Like</a>
                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                      >Hate</a
                    >
                  </td>
                </tr>
              </tbody>
              <InfiniteLoading @infinite="loadData" />
            </table>
          </div>
        </div>
      </div>
    </div>
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
</style>