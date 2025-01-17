<script setup>
import { Link } from '@inertiajs/vue3';
import useTimeAgo from '../../../Utils/useTimeAgo';

const props = defineProps({ comment: Object });

const timeSinceCreated = useTimeAgo(props.comment.created_at);
</script>

<template>
  <div class="d-flex align-items-center">
    <img :src="comment.user.avatar" class="profile-picture-sm me-2">
    <Link :href="'/users/'" class="text-dark text-decoration-none fw-bold me-2">{{ comment.user.username }}</Link>
    <span class="text-muted fs-6">• {{ timeSinceCreated }}</span>
  </div>

  <p class="ms-5">{{ comment.body }}</p>
</template>

<style scoped>
.profile-picture-sm {
  border-radius: 50%;
  border: 2px solid #fff;
  object-fit: cover;
  width: 38px;
}
</style>