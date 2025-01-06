<script setup>
import ProfileData from './Components/ProfileData.vue';
import ProfilePosts from './Components/ProfilePosts.vue';

defineProps({
  user: Object,
  posts: [Object],
  likedPosts: [Object]
})
</script>

<template>
  <div class="container wrapper">
    <section class="mt-5">
      <ProfileData :user="user"/>
    </section>

    <section class="mt-3">
      <ProfilePosts :posts="posts" :likedPosts="likedPosts"/>
    </section>
  </div>
</template>

<style scoped>
.wrapper {
  max-width: 768px
}
</style>