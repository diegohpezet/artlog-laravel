<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ post: Object });

const page = usePage();
const user = page.props.auth.user;

const likeCount = ref(props.post.likes.length);
const isLiked = ref(props.post.likes.some(like => like.user_id === user?.id));

const toggleLike = async () => {
  const response = await fetch(`/posts/${props.post.id}/like`, {
    method: isLiked.value ? 'DELETE' : 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    }
  });

  if (response.ok) {
    const data = await response.json();
    likeCount.value = data.like_count;
    isLiked.value = !isLiked.value;
  }
};
</script>

<template>
  <button :class="`btn btn-outline-dark w-100 ${!user ? 'disabled' : ''}`" @click="toggleLike">
    <i v-if="!isLiked" class="bi bi-heart me-2"></i>
    <i v-else class="bi bi-heart-fill me-2"></i>
    {{ likeCount }}
  </button>
</template>