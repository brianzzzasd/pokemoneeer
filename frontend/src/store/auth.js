import fetch from '../plugins/fetch'
import defineStore from 'pinia'

export const useAuth = defineStore('auth-store', {
  state: () => {
    return {
      user: null,
      token: null,
      fetching: false
    }
  },
  
  getters: {
    user(state) {
      return state.user;
    },

    token(state) {
      return state.token;
    },

    isFetching(state) {
      return state.fetching;
    },

    isAuthenticated(state) {
      return !!state.user;
    },
  },

  actions: {
    async login(email, password) {
      this.fetching = true;

      try {
        const response = await fetch.post('/auth/login', { email, password });
        this.token = response.data.token;
        this.user = response.data.user;
      } catch (err) {
        this.token = null;
        this.user = null;
        console.error('Error logging in:', err);
        return err;
      }

      this.fetching = false;

      return response;
    },

    async logout() {
      this.fetching = true;

      try {
        const response = await fetch.post('/auth/logout');
        this.token = null;
        this.user = null;
      } catch (err) {
        console.error('Error logging out:', err);
        return err;
      }

      this.fetching = false;

      return response;
    },

    async register(email, password) {
      this.fetching = true;

      try {
        const response = await fetch.post('/auth/register', { email, password });
        this.token = response.data.token;
        this.user = response.data.user;
      } catch (err) {
        this.token = null;
        this.user = null;
        console.error('Error registering:', err);
        return err;
      }

      this.fetching = false;

      return response;
    },
    
    async fetchUser() {
      this.fetching = true;

      try {
        const response = await fetch.get('/auth/user');
        this.user = response.data.user;
      } catch (err) {
        this.user = null;
        console.error('Error fetching user:', err);
        return err
      }

      this.fetching = false;

      return response;
    },
  }
})