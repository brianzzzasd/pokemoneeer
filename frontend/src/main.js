import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import { createPinia } from 'pinia'
import App from './App.vue'

const store = createPinia()

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/login', 
            name: 'Login',
            component: () => import('./pages/Login.vue'),
            meta: {
                hideNavbar: true,
            }
        },
        { 
            path: '/',
            name: 'Pokemons',
            component: () => import('./pages/Pokemons.vue') 
        },
        { 
            path: '/users',
            name: 'Users',
            component: () => import('./pages/Users.vue')
        },
    ],
})

const app = createApp(App)

app.use(router)
.use(store)

app.mount('#app')
