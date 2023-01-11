import fetch from '../plugins/fetch';
import { defineStore } from 'pinia'

export const usePokemon = defineStore('pokemon-store', {
  state: () => ({
    pokemons: [],
    fetching: false
  }),

  getters: {
    results(state) {
      return state.pokemons;
    },

    isFetching(state) {
      return state.fetching;
    }
  },

  actions: {
    async fetchPokemons(offset = 0) {
      this.fetching = true;
      const response = await fetch.get(`/pokemon?offset=${offset}`);

      try {
        this.pokemons.push(...response.data.data)
      } catch (err) {
        this.pokemons = [];
        console.error('Error loading new Pokemons:', err);
        return err;
      }

      this.fetching = false;

      return response
    },
  }
})