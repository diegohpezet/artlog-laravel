<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ user: Object });

const form = useForm({
  avatar: props.user.avatar,
  username: props.user.username,
  description: props.user.description
});
const submit = () => {
  form.put('/users/' + props.user.id);
};
</script>

<template>
  <div class="container mt-3">
    <h1>Edit profile</h1>
    <form @submit.prevent="submit">
      <div class="mb-3">
        <label for="avatar" class="form-label">Avatar</label>
        <input type="text" class="form-control" id="avatar" v-model="form.avatar">
        <span class="text-danger">{{ form.errors.avatar }}</span>
      </div>

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" v-model="form.username">
        <span class="text-danger">{{ form.errors.username }}</span>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" v-model="form.description">
        <span class="text-danger">{{ form.errors.description }}</span>
      </div>

      <button type="submit" class="btn btn-dark w-100">Submit</button>
    </form>
  </div>
</template>