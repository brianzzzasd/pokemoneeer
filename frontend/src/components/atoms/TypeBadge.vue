<script>
export default {
  name: 'TypeBadge',
  props: {
    type: String,
    default: 'grass',
  },
  methods: {
    getClass() {
      return this.type
    },
  },
}
</script>

<template>
  <span
    class="inline-flex rounded-ful px-2 text-xs font-semibold leading-5 text-white capitalize"
    :class="getClass()"
  >
    {{ type }}
  </span>
</template>

<style scoped>
  .normal {
    background-color: #A8A878;
    border-top-color: #D8D8D0;
    border-bottom-color: #705848;
  }

  .fire {
    background-color: #F08030;
    border-top-color: #F8D030;
    border-bottom-color: #C03028;
  }

  .water {
    background-color: #6890F0;
    border-top-color: #98D8D8;
    border-bottom-color: #807870;
  }

  .grass {
    background-color: #78C850;
    border-top-color: #C0F860;
    border-bottom-color: #588040;
  }

  .electric {
    background-color: #F8D030;
    border-top-color: #F8F878;
    border-bottom-color: #B8A038;
  }

  .ice {
    background-color: #98D8D8;
    border-top-color: #D0F8E8;
    border-bottom-color: #9090A0;
  }

  .fighting {
    background-color: #C03028;
    border-top-color: #F08030;
    border-bottom-color: #484038;
  }

  .poison {
    background-color: #A040A0;
    border-top-color: #D880B8;
    border-bottom-color: #483850;
  }

  .ground {
    background-color: #E0C068;
    border-top-color: #F8F878;
    border-bottom-color: #886830;
  }

  .flying {
    background-color: #A890F0;
    border-top-color: #C8C0F8;
    border-bottom-color: #705898;
  }

  .psychic {
    background-color: #F85888;
    border-top-color: #F8C0B0;
    border-bottom-color: #789010;
  }

  .bug {
    background-color: #A8B820;
    border-top-color: #D8E030;
    border-bottom-color: #A8B820;
  }

  .rock {
    background-color: #B8A038;
    border-top-color: #E0C068;
    border-bottom-color: #886830;
  }

  .ghost {
    background-color: #705898;
    border-top-color: #A890F0;
    border-bottom-color: #483850;
  }

  .dark {
    background-color: #705848;
    border-top-color: #A8A878;
    border-bottom-color: #484038;
  }

  .dragon {
    background-color: #7038F8;
    border-top-color: #B8A0F8;
    border-bottom-color: #483890;
  }

  .steel {
    background-color: #B8B8D0;
    border-top-color: #D8D8C0;
    border-bottom-color: #807870;
  }

  .fairy {
    background-color: #F0B6BC;
    border-top-color: #F5CAD1;
    border-bottom-color: #905F63;
  }
</style>
