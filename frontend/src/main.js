import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'
import { createPinia } from 'pinia'
import App from './App.vue'

const store = createPinia()

const routes = [
    { 
        path: '/login', 
        name: 'Login',
        component: () => import('./pages/Login.vue'),
        meta: {
            hideNavbar: true,
        }
    },
    { 
        path: '/register', 
        name: 'Register',
        component: () => import('./pages/Register.vue'),
        meta: {
            hideNavbar: true,
        }
    },
    { 
        path: '/',
        name: 'Pokemons',
        component: () => import('./pages/Pokemons.vue'),
        meta: {
            requiresAuth: true,
        }
    },
    { 
        path: '/users',
        name: 'Users',
        component: () => import('./pages/Users.vue'),
        meta: {
            requiresAuth: true,
        }
    },
    { 
        path: '/profile',
        name: 'Profile',
        component: () => import('./pages/Profile.vue'),
        meta: {
            requiresAuth: true,
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !localStorage.getItem('token')) {
        next({ name: 'Login' })
    } else {
        next()
    }
})

const app = createApp(App)

app.use(router)
.use(store)

app.mount('#app')
