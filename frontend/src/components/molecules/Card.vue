<template>
  <div class="border border-gray-200 bg-white px-4 py-5 sm:px-6 rounded-lg">
    <div class="-ml-4 -mt-4 flex flex-wrap items-center justify-between sm:flex-nowrap">
      <div class="ml-4 mt-4">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-12 w-12 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Tom Cook</h3>
            <p class="text-sm text-gray-500">
              <a href="#">@tom_cook</a>
            </p>
          </div>
        </div>
      </div>
      <div>Pikatsu</div>
    </div>
    <div class="border-b border-gray-200 mt-5"></div>
    <div class="flex mt-2 text-gray-700">
      <div class="w-1/2">
        <div>
        Hates
        </div>
        <div>
        qwe
        </div> 
      </div>
      <div class="w-1/2">
        <div>
        Likes
        </div>
        <div>
        qwe
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