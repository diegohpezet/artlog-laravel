<script setup>
defineProps({  post: Object  })
</script>

<template>
  <form :action="'/posts/' + post.id" method="PUT">
    <div class="mb-3">
      <label for="image_url" class="form-label">Image url</label>
      <input type="text" class="form-control" id="image_url" name="image_url" :value="post.image_url">
    </div>

    <div class="mb-3">
      <label for="user_id" class="form-label">User</label>
      <input type="text" class="form-control" id="user_id" name="user_id" :value="post.user_id">
    </div>
  </form>
</template>