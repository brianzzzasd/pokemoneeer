<template>
  <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 rounded-lg mb-5">
    <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
      <div class="ml-4 mt-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-12 w-12 rounded-full" :src="user.avatar" alt="" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">{{ user.name }}</h3>
            <p class="text-sm text-gray-500">
              <a href="#">@{{ user.name.toLowerCase().replace(/\s/g, '') }}</a>
            </p>
          </div>
        </div>
      </div>
      <div>
        <div class="flex items-center" v-if="user.favorite">
          <img class="w-5 h-5" :src="user.favorite.pokemon.sprite" alt=""/>
          <span class="font-bold mx-2">{{  user.favorite.pokemon.name }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="yellow" class="w-5 h-5 favorite-icon">
            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
          </svg>
        </div>
        <div v-else>
          ----
        </div>
      </div>
    </div>
    <div class="border-b border-gray-200 mt-5"></div>
    <div class="flex mt-2 text-gray-700">
      <div class="w-1/2">
        <div class="font-bold">
        Hates
        </div>
        <div class="mt-3">
          <div v-if="user.hates.length" v-for="hate in user.hates" class="flex items-center">
            <div>
              <img class="w-5 h-5" :src="hate.pokemon.sprite" alt="">
            </div>
            <div class="ml-2 text-sm">{{ hate.pokemon.name }}</div>
          </div>
          <div v-else>
            -
          </div>
        </div> 
      </div>
      <div class="w-1/2">
        <div class="font-bold">
        Likes
        </div>
        <div class="mt-3">
          <div v-if="user.likes.length" v-for="like in user.likes" class="flex items-center">
            <div>
              <img class="w-5 h-5" :src="like.pokemon.sprite" alt="">
            </div>
            <div class="ml-2 text-sm">{{ like.pokemon.name }}</div>
          </div>
          <div v-else>
            -
          </div>
        </div> 
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'Card',
    props: ['user'],
  }
</script>