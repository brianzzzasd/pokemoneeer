<script setup>
import "./assets/tailwind.css";
import NavBar from './components/layouts/NavBar.vue'
import Footer from './components/layouts/Footer.vue'

import { useAuth } from './store/auth.js'
import { storeToRefs } from 'pinia'
import { onMounted, ref } from 'vue'

onMounted(() => {
  const store = useAuth()
  const { user } = storeToRefs(store)
  const { fetchUser } = store

  fetchUser()
})

</script>

<template>
  <template v-if="$route.meta.hideNavbar">
    <RouterView />
  </template>
  <template v-else>
    <NavBar />
      <RouterView class="mt-8"/>
    <Footer />
  </template>
</template>

<style scoped>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
