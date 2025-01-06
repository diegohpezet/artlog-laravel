<script setup>
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Masonry from 'masonry-layout';
import imagesLoaded from 'imagesloaded';
import PostCard from './Components/PostCard.vue';

const props = defineProps({ posts: [Object] });

const masonryInstance = ref(null);

const initMasonry = () => {
  const grid = document.querySelector('.masonry-grid');
  imagesLoaded(grid, () => {
    masonryInstance.value = new Masonry(grid, {
      percentPosition: true,
    });
  });
};

onMounted(() => {
  initMasonry();
});
</script>

<template>
  <div class="container mt-3">
    <nav class="mb-3">
      <ul class="nav">
        <li class="nav-item">
          <Link class="nav-link" :href="'/'">All</Link>
        </li>
        <li class="nav-item">
          <Link class="nav-link" :href="'/posts/filter/following'">Following</Link>
        </li>
      </ul>
    </nav>

    <main class="row masonry-grid" style="position: relative;">
      <div class="col-sm-6 col-md-4 col-lg-3 mb-4" v-for="post in posts" :key="post.id">
        <PostCard :post />
      </div>
    </main>
  </div>
</template>

<style scoped>
.masonry-grid {
  width: calc(100% + 24px);
  margin-left: -8px;
}
</style>