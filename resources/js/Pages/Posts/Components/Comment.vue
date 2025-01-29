<script setup>
import { ref } from 'vue';
import { Link, usePage, useForm } from '@inertiajs/vue3';
import useTimeAgo from '../../../Utils/useTimeAgo';

const props = defineProps({ comment: Object });
const emit = defineEmits(['comment-edit', 'comment-delete']);

const page = usePage();
const currentUser = page.props.auth.user;

const timeSinceCreated = useTimeAgo(props.comment.created_at);

const form = useForm({
  body: props.comment.body,
});

const isEditing = ref(false);
const handleCommentEdit = () => {
  isEditing.value = true;
};

const handleEditSubmit = () => {
  emit('comment-edit', { ...props.comment, body: form.body });
  isEditing.value = false;
};

const handleCommentDelete = () => {
  if (confirm('Are you sure you want to delete this comment?')) {
    emit('comment-delete', props.comment);
  }
};
</script>

<template>
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <img :src="comment.user.avatar" class="profile-picture-sm me-2">
      <Link :href="'/users/'" class="text-dark text-decoration-none fw-bold me-2">{{ comment.user.username }}</Link>
      <span class="text-muted fs-6">• {{ timeSinceCreated }}</span>
    </div>

    <div class="d-flex justify-content-end dropdown" v-if="currentUser?.id === comment.user.id">
      <button class="btn btn-sm btn-outline-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-three-dots-vertical py-2"></i>
      </button>
      <ul class="dropdown-menu">
        <li><button class="dropdown-item btn-light" type="button" @click="handleCommentEdit()">Edit</button></li>
        <li><button class="dropdown-item btn-light" type="button" @click="handleCommentDelete()">Delete</button></li>
      </ul>
    </div>
  </div>

  <p v-if="!isEditing" class="ms-5">{{ comment.body }}</p>

  <form v-else @submit.prevent="handleEditSubmit" class="ms-5">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Comment..." v-model="form.body">
      <button class="btn btn-outline-dark" type="submit" :disabled="form.processing">+</button>
    </div>
    <span v-if="form.errors.body" class="text-danger">{{ form.errors.body }}</span>
  </form>
</template>

<style scoped>
.profile-picture-sm {
  border-radius: 50%;
  border: 2px solid #fff;
  object-fit: cover;
  width: 38px;
}
</style>