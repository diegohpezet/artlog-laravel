<script setup>
import { Link } from '@inertiajs/vue3';
import LikeBtn from './LikeBtn.vue';

const props = defineProps({ post: Object });
</script>

<template>
  <div class="card">
    <div class="card-body p-0">
      <div class="user-info">
        <img :src="post.user.avatar" :alt="post.user.username">
        <Link :href="'/users/' + post.user.username">{{ post.user.username }}</Link>
      </div>

      <div class="post-image">
        <Link :href="'/posts/' + post.id">
          <img :src="post.image_url" class="w-100 rounded" alt="Post image">
        </Link>
      </div>

      <div class="actions">
        <LikeBtn :post="post" />
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.card {
  position: relative;

  .user-info {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    padding: 5px;
    filter: none;
    z-index: 10;

    img {
      width: 38px;
      margin-right: 5px;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    a {
      color: #fff;
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;

      &:hover {
        text-decoration: underline;
      }
    }
  }

  .actions {
    display: none;
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 5px;
    z-index: 10;
  }

  &:hover {

    .user-info,
    .actions {
      display: block;
    }

    ;

    .post-image img {
      filter: brightness(75%);
    }
  }
}
</style>