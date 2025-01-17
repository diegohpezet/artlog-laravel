<script setup>
import serverRequest from '../../../Utils/serverRequest';
import Comment from './Comment.vue';
import CommentForm from './CommentForm.vue';
import { reactive } from 'vue';

const props = defineProps({ post: Object });
const post = reactive(props.post);

const addComment = (comment) => {
  post.comments = [...post.comments, comment];
};

const editComment = (updatedComment) => {
  serverRequest(`/comments/${updatedComment.id}`, 'PUT', updatedComment);
  const index = post.comments.findIndex((comment) => comment.id === updatedComment.id);
  if (index !== -1) {
    post.comments[index] = updatedComment;
  }
};

const deleteComment = (comment) => {
  serverRequest(`/comments/${comment.id}`, 'DELETE');
  post.comments = post.comments.filter((c) => c.id !== comment.id);
}
</script>

<template>
  <h5>Comments ({{ post.comments.length }})</h5>
  <CommentForm :post="post" @comment-created="addComment"/>
  <ul class="list-group list-group-flush">
    <li class="list-group-item list-group-item-action" v-for="comment in post.comments" :key="comment.id">
      <Comment 
        :comment="comment"
        @comment-delete="deleteComment"
        @comment-edit="editComment"
      />
    </li>
  </ul>
</template>