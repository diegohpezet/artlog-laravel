<script setup>
import { Link } from '@inertiajs/vue3';
import LikeBtn from './LikeBtn.vue';
import { ref } from 'vue';
import PostComments from './PostComments.vue';

const props = defineProps({ post: Object });

const imageLoaded = ref(false);
const imageSrc = ref('');

imageSrc.value = props.post.image_url;

function handleImageLoad() {
  imageLoaded.value = true;
}
</script>


<template>
  <div class="card">
    <div class="card-body p-0">
      <div class="d-flex justify-content-between">
        <section name="user" class="user-info">
          <img :src="post.user.avatar" :alt="post.user.username">
          <Link :href="'/users/' + post.user.username">{{ post.user.username }}</Link>
        </section>

        <section class="actions">
          <LikeBtn :post="post" />
        </section>
      </div>

      <p class="px-3">{{ post.description }}</p>

      <section name="image" class="post-image px-3 pb-3 text-center">
        <Link :href="'/posts/' + post.id">
          <div v-if="!imageLoaded" class="spinner-border text-dark" role="status"></div>
          <img
            v-show="imageLoaded"
            :src="imageSrc"
            class="w-100 rounded"
            alt="Post image"
            @load="handleImageLoad"
          >
        </Link>
      </section>

      <section name="comments" class="px-3">
        <PostComments :post="post" />
      </section>
    </div>
  </div>
</template>


<style scoped lang="scss">
.card {
  position: relative;

  .user-info {
    display: flex;
    align-items: center;
    padding: 10px;
    filter: none;
    z-index: 10;

    img {
      width: 38px;
      margin-right: 5px;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    a {
      color: #000;
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;

      &:hover {
        text-decoration: underline;
      }
    }
  }

  .actions {
    padding: 10px;
  }

  &:hover {
    .post-image img {
      filter: brightness(75%);
    }
  }
}
</style>