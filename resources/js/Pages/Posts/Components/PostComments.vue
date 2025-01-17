<script setup>
import Comment from './Comment.vue';
import CommentForm from './CommentForm.vue';
import { reactive } from 'vue';

const props = defineProps({ post: Object });
const post = reactive(props.post);

const addComment = (comment) => {
  post.comments = [...post.comments, comment];
};
</script>

<template>
  <h5>Comments ({{ post.comments.length }})</h5>
  <CommentForm :post="post" @comment-created="addComment"/>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-action" v-for="comment in post.comments" :key="comment.id">
      <Comment :comment="comment" />
    </li>
  </ul>
</template>