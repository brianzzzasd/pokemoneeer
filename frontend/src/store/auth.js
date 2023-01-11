import fetch from '../plugins/fetch'
import { defineStore } from 'pinia'

export const useAuth = defineStore('auth-store', {
  state: () => ({
    user: null,
    token: null,
    fetching: false
  }),
  
  getters: {
    resultUser(state) {
      return state.user
    },

    resultToken(state) {
      return state.token
    },

    isFetching(state) {
      return state.fetching
    },

    isAuthenticated(state) {
      return !!state.user
    },
  },

  actions: {
    async login(email, password) {
      try {
        const response = await fetch.post('/auth/login', { email, password })
        this.user = response.data.user

        localStorage.setItem('token', response.data.token)

        return {
          data: response.data,
          code: 'ok',
        }
      } catch (err) {
        return {
          errors: [err.response.data.message],
          code: 'error',
        }
      }

      this.fetching = false
    },

    async logout() {
      try {
        localStorage.removeItem('token')
        this.user = null
      } catch (err) {
        console.error('Error logging out:', err)
        return err
      }
    },

    async register(data) {
      this.fetching = true

      try {
        const response = await fetch.post('/auth/register', data)

        localStorage.setItem('token', response.data.token)
        this.user = response.data.user

        return {
          data: response.data,
          code: 'ok',
        }
      } catch (err) {
        return {
          errors: Object.values(err.response.data.errors).flat(),
          code: 'error',
        }
      }
    },
    
    async updateUser(data) {
      try {
        const response = await fetch.post('/user', data)
        this.user = response.data.user

        return {
          data: response.data,
          code: 'ok',
        }
      } catch (err) {
        return {
          errors: Object.values(err.response.data.errors).flat(),
          code: 'error',
        }
      }
    },

    async fetchUser() {
      this.fetching = true

      try {
        const response = await fetch.get('/user')
        this.user = response.data.user
      } catch (err) {
        this.user = null
        console.error('Error fetching user:', err)
        return err
      }

      this.fetching = false
    },

    async requestCookie() {
      this.fetching = true

      try {
        const response = await fetch.get('http://localhost:8000/sanctum/csrf-cookie')
      } catch (err) {
        console.error('Error requesting cookie:', err)
        return err
      }
    },
  }
})