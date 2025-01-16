<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import PostCard from './Components/PostCard.vue';
import axios from 'axios';

const props = defineProps({ posts: [Object] });
const localPosts = ref({ ...props.posts });

const isLoading = ref(false);

const handleScroll = () => {
  const distanceFromBottom = document.documentElement.offsetHeight - window.scrollY - window.innerHeight;

  if (distanceFromBottom < 200 && localPosts.value.next_page_url && !isLoading.value) {
    isLoading.value = true;
    axios.get(localPosts.value.next_page_url).then((response) => {
      localPosts.value = {
        ...localPosts.value,
        data: [...localPosts.value.data, ...response.data.data],
        next_page_url: response.data.next_page_url,
      };
      isLoading.value = false;
    }).catch(() => {
      isLoading.value = false;
    });
  }
};

onMounted(() => { 
  window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
  <div class="container mt-3 w-50 mx-auto">
    <nav class="mb-3">
      <!-- Filter tabs -->
      <ul class="nav">
        <li class="nav-item">
          <Link class="nav-link" :href="'/'">All</Link>
        </li>
        <li class="nav-item">
          <Link class="nav-link" :href="'/posts/filter/following'">Following</Link>
        </li>
      </ul>
    </nav>

    <!-- Post cards -->
    <main class="d-flex flex-wrap">
      <div class="p-3 w-100" v-for="post in localPosts.data" :key="post.id">
        <PostCard :post />
      </div>
    </main>
  </div>
</template>