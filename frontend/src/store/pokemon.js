
import axios from 'axios';
import { defineStore } from 'pinia'

export const usePokemon = defineStore('pokemon-store', {
  state: () => {
    return {
      pokemons: [],
      fetching: false
    }
  },

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
      const response = await axios.get(`http://localhost:8000/api/pokemon?offset=${offset}`);
      
      try {
        this.pokemons.push(...response.data.data)
      } catch (err) {
        this.pokemons = [];
        console.error('Error loading new Pokemons:', err);
        return err;
      }

      this.fetching = false;
    },
  }
})