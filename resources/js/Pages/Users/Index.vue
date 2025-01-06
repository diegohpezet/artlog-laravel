<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({ users: [Object] });
</script>

<template>
  <div class="container">
    <h1>Users</h1>

    <p v-if="users.length == 0">There are no users to show here...</p>

    <ul v-else class="list-group">
      <Link v-for="user in users" :href="'/users/' + user.username" class="list-group-item list-group-item-action text-decoration-none">
        <div class="d-flex align-items-center">
          <img :src="user.avatar" alt="" class="rounded-circle border me-2" style="width: 45px; height: 45px;">
          <span class="fw-bold ">{{ user.username }}</span>
        </div>
      </Link>
    </ul>
  </div>
</template>