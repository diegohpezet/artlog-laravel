<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

const username = ref('');

const searchUsers = () => {
  if (username.value.length <= 3) {
    return
  }

  router.get('/users', { username: username.value });
  username.value = '';
}
</script>

<template>
  <form class="d-flex flex-grow-1 my-auto" @submit.prevent="searchUsers">
    <div class="input-group">
      <input 
        class="form-control shadow-none"
        :class="username.length > 0 && username.length <= 3 ? 'border-danger' : 'border-secondary'"
        id="searchbar"
        name="username"
        type="text"
        v-model="username"
        placeholder="Search users on ArtLog"
      />
      <button class="btn btn-secondary" id="searchbutton" type="submit"><i class="bi bi-search"></i></button>
    </div>
  </form>
</template>