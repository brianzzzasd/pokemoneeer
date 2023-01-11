import { defineStore } from 'pinia'
import fetch from '../plugins/fetch'

export const usePokemon = defineStore('pokemon-store', {
  state: () => ({
    pokemons: [],
    filteredPokemons: [],
    fetching: false,
    filtering: false,
  }),

  getters: {
    results(state) {
      return state.pokemons
    },

    isFetching(state) {
      return state.fetching
    },
  },

  actions: {
    async fetchPokemons(offset = 0, query = '', fromSearch = false) {
      this.fetching = true
      const response = await fetch.get(`/pokemon?offset=${offset}&string=${query}`)

      try {
        if (query) {
          this.pokemons = response.data.data
        }

        else {
          if (fromSearch)
            this.pokemons = []

          this.pokemons.push(...response.data.data)
        }

        this.filteredPokemons = this.pokemons
      }
      catch (err) {
        this.pokemons = []
        console.error('Error loading new Pokemons:', err)
        return err
      }

      this.fetching = false

      return response
    },

    async filter(query) {
      this.filtering = true

      if (query === '')
        this.filtering = false

      this.fetchPokemons(0, query, true).then(() => {
        this.filteredPokemons = this.pokemons
      })
    },

    async addHate(id) {
      try {
        const response = await fetch.post(`pokemon/hate/${id}`)

        return {
          data: response.data,
          code: 'ok',
        }
      }
      catch (err) {
        return {
          errors: [err.response.data.message],
          code: 'error',
        }
      }
    },

    async addLike(id) {
      try {
        const response = await fetch.post(`pokemon/like/${id}`)

        return {
          data: response.data,
          code: 'ok',
        }
      }
      catch (err) {
        return {
          errors: [err.response.data.message],
          code: 'error',
        }
      }
    },

    async addFavorite(id) {
      try {
        const response = await fetch.post(`pokemon/favorite/${id}`)

        return {
          data: response.data,
          code: 'ok',
        }
      }
      catch (err) {
        return {
          errors: [err.response.data.message],
          code: 'error',
        }
      }
    },
  },
})
