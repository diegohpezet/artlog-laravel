<script setup>
import Comment from './Comment.vue';

const props = defineProps({ post: Object });
</script>

<template>
  <h5>Comments ({{ post.comments.length }})</h5>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-action" v-for="comment in post.comments">
      <Comment :comment="comment" />
    </li>
  </ul>
</template>