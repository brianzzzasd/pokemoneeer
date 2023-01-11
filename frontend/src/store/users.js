import fetch from '../plugins/fetch';
import { defineStore } from 'pinia'

export const useUsers = defineStore('users-store', {
  state: () => ({
    users: [],
    fetching: false
  }),

  getters: {
    results(state) {
      return state.users;
    },

    isFetching(state) {
      return state.fetching;
    }
  },

  actions: {
    async fetchUsers(offset = 0) {
      this.fetching = true;
      try {
        const response = await fetch.get(`/users?offset=${offset}`);
        this.users.push(...response.data.users)
      } catch (err) {
        this.users = []
        console.error(err)
      }

      this.fetching = false;
    },
  },
});

