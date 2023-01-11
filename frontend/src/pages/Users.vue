<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { onMounted, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useUsers } from '../store/users.js'
import Card from '../components/molecules/Card.vue'
import InfiniteLoading from '../components/organisims/InfiniteLoading.vue'

const store = useUsers()

const page = ref(0)
const { users } = storeToRefs(store)
const { fetchUsers } = store

const loadData = async ($state) => {
  $state.loading()
  try {
    const offset = users.value.length
    const response = await fetchUsers(offset)

    if (response.length < 6)
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
          Users
        </h1>
      </div>
    </div>
    <div id="pokes">
      <div class="flex flex-wrap justify-around mt-8 mx-10 border border-gray-200 rounded pt-5">
        <div
          v-for="user in users"
          :key="user.email"
          class="w-5/12 mx-1"
        >
          <Card :user="user" />
        </div>
      </div>
      <InfiniteLoading @infinite="loadData" />
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
  max-height: 700px;
  overflow-y: scroll;
}
</style>
