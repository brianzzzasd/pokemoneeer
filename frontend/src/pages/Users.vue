<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid'
import { onMounted, ref } from 'vue';
import { useUsers } from '../store/users.js'
import { storeToRefs } from "pinia";
import Card from '../components/molecules/Card.vue'

const store = useUsers();

const page = ref(0);
const { users } = storeToRefs(store);
const { fetchUsers } = store;

onMounted(async () => {
  await fetchUsers(0);
});

const loadData = async $state => {
  $state.loading()
  try {
    const offset = users.value.length
    const response = await fetchUsers(offset)
    
    if (response.length < 6)
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
      </div>
    </div>
    <div class="flex flex-col">
      <div class="flex flex-wrap justify-around mt-8 mx-10">
        <div class="w-1/3 mx-2" v-for="user in users" :key="user.email"><Card :user="user"/></div>
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