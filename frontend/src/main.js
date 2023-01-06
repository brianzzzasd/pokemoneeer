import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import { createPinia } from 'pinia'
import App from './App.vue'
import Home from './pages/Home.vue'
import TestInfinite from './pages/TestInfinite.vue'
import axios from './plugins/axios'

const store = createPinia()
const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', name: 'Home', component: Home },
        { path: '/test', name: 'Test', component: TestInfinite }
    ],

})

createApp(App)
.use(router)
.use(store)
.use(axios, {
    baseUrl: 'http://localhost:8000/',
}).mount('#app')
