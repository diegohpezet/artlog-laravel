<script setup>
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({ post: Object });

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
  <div class="container mt-3">
    <figure>
      <figcaption class="d-flex justify-content-between align-items-center mb-3">
        <Link :href="'/users/' + post.user.username" class="text-decoration-none">
          <img :src="post.user.avatar" class="rounded-circle me-2" style="width: 45px; height: 45px;">
          <span class="fw-bold text-dark">{{ post.user.username }}</span>
        </Link>

        <div>
          <button class="btn btn-light border ">
            <i class="bi bi-heart-fill me-2"></i>
            {{ post.likes.length }}
          </button>
        </div>
      </figcaption>

      <div class="d-flex justify-content-center">
        <img :src="post.image_url" alt="post_image" class="picture">
      </div>
      
    </figure>
  </div>
</template>

<style scoped>
.picture {
  max-width: 100%;
  max-height: 65vh;
}
</style>