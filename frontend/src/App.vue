<script setup>
import './assets/tailwind.css'
import NavBar from './components/layouts/NavBar.vue'
import Footer from './components/layouts/Footer.vue'
</script>

<template>
  <template v-if="$route.meta.hideNavbar">
    <RouterView />
  </template>
  <template v-else>
    <NavBar />
    <RouterView class="mt-8" />
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
