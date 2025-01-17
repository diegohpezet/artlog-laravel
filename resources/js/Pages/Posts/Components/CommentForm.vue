<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({ post: Object });
const emit = defineEmits(['comment-created']);

const form = useForm({
  body: '',
});

const submit = async () => {
  const response = await fetch(`/posts/${props.post.id}/comments`, {
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ body: form.body })
  });

  if (!response.ok) {
    const data = await response.json();
    form.errors = data.errors;
  }

  const newComment = await response.json();
  console.log(newComment)
  emit('comment-created', newComment);
  form.reset();
};
</script>

<template>
  <form @submit.prevent="submit">
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Comment..." v-model="form.body">
      <button class="btn btn-outline-dark" type="submit" :disabled="form.processing">+</button>
    </div>
    <span v-if="form.errors.body" class="text-danger">{{ form.errors.body }}</span>
  </form>
</template>