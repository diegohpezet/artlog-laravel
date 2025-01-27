<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import PostComments from './Components/PostComments.vue';

const props = defineProps({ post: Object });

const page = usePage();
const user = page.props.auth.user;
</script>

<template>
  <div class="container mt-3">

    <section name="user" class="d-flex justify-content-between align-items-center mb-3">
      <Link :href="'/users/' + post.user.username" class="text-decoration-none">
      <img :src="post.user.avatar" class="rounded-circle me-2" style="width: 45px; height: 45px;">
      <span class="fw-bold text-dark">{{ post.user.username }}</span>
      </Link>

      <button class="btn btn-light border ">
        <i class="bi bi-heart-fill me-2"></i>
        {{ post.likes.length }}
      </button>
    </section>

    <div class="row">
      <div class="col-12 col-md-6 col-image">
        <section name="image" class="d-flex justify-content-center align-items-center">
          <img :src="post.image_url" alt="post_image" class="picture">
        </section>
      </div>
      <div class="col-12 col-md-6">
        <section name="comments" class="mt-3 mt-md-0">
          <PostComments :post="post" />
        </section>
      </div>
    </div>

  </div>
</template>

<style scoped>
.picture {
  max-width: 100%;
  max-height: 65vh;
}

@media screen and (min-width: 768px) {
  .col-image {
    position: sticky;
    top: 35;
    align-self: flex-start;
    background-color: white;
    z-index: 10;
  }
}
</style>