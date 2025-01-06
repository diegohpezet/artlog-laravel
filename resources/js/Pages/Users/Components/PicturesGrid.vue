<script setup>
import { Link } from '@inertiajs/vue3';
import LikeBtn from '../../Posts/Components/LikeBtn.vue';

const props = defineProps({ posts: [Object] });
</script>

<template>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-2">
      <div class="col" v-for="post in posts" :key="post.id">
        <div class="h-100 position-relative">
          <Link :href="'/posts/' + post.id" class="image-container rounded">
              <img :src="post.image_url" class="card-img-top border rounded zoomed-image" alt="User post">
          </Link>
          <LikeBtn :post="post" class="position-absolute bottom-0 end-0 m-2 w-auto" />
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.image-container {
  height: 235px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}

.zoomed-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transform: scale(1.2);
  transform-origin: center center;
}

.zoomed-image:hover {
  filter: brightness(85%);
}
</style>
