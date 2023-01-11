<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { ref } from 'vue';
import { usePokemon } from '../store/pokemon.js'
import { storeToRefs } from "pinia";
import Card from '../components/molecules/Card.vue'
const store = usePokemon();

const page = ref(0);
const { pokemons } = storeToRefs(store);
const { fetchPokemons } = store;

const loadData = async $state => {
  $state.loading()
  try {
    const offset = pokemons.value.length
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
        <h1 class="text-xl font-semibold text-gray-900">Users</h1>
        <p class="mt-2 text-sm text-gray-700">List of Pokemons to chose from!</p>
      </div>
      <div class="flex flex-1 items-center justify-center px-2 lg:ml-6 lg:justify-end">
        <div class="w-full max-w-lg lg:max-w-xs">
          <label for="search" class="sr-only">Search</label>
          <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <MagnifyingGlassIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
            </div>
            <input id="search" name="search" class="block w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-3 leading-5 placeholder-gray-500 focus:border-indigo-500 focus:placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" placeholder="Search" type="search" />
          </div>
        </div>
      </div>
    </div>
    <div>
      <Card />
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