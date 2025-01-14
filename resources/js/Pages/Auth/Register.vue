<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AuthLayout from './Layout/AuthLayout.vue';

const form = useForm({
  username: "",
  email: "",
  password: "",
  password_confirmation: ""
});

const handleUsername = (e) => {
  const cleanValue = e.target.value
    .toLowerCase()
    .replace(/[^a-z0-9._-]/g, '')
    .replace(/\s+/g, '');

  form.username = cleanValue;
  e.target.value = cleanValue;
};

const submit = () => {
  form.post('/auth/register');
  form.reset();
};
</script>

<template>
  <AuthLayout>

    <img :src="'/assets/images/camera.png'" alt="camera" class="d-none d-md-block position-absolute img-small"
      style="bottom: -50px; left: -50px;">
    <img :src="'/assets/images/plant.png'" alt="plant" class="d-none d-md-block position-absolute img-small"
      style="bottom: -50px; right: -50px;">
    <form @submit.prevent="submit" class="w-100">
      <h3 class="text-center mb-4 text-uppercase">New Account?</h3>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
          <input type="text" class="form-control" placeholder="Username" aria-label="Username" autofocus
            v-model="form.username" @input="handleUsername">
        </div>
        <div v-if="form.errors.username" class="text-danger">{{ form.errors.username }}</div>
      </div>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" placeholder="Mail" aria-label="Mail" v-model="form.email">
        </div>
        <div v-if="form.errors.email" class="text-danger">{{ form.errors.email }}</div>
      </div>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
          <input type="password" class="form-control" placeholder="Password" aria-label="Password"
            v-model="form.password">
        </div>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-arrow-counterclockwise"></i></span>
        <input type="password" class="form-control" placeholder="Repeat password" aria-label="Repeat password"
          v-model="form.password_confirmation">
      </div>

      <div v-if="form.errors.password" class="text-danger">{{ form.errors.password }}</div>

      <button class="btn btn-dark w-100 mt-3" type="submit">
        Register
      </button>

      <div class="text-center mt-3">
        <Link href="/auth/login">Already have an account?</Link>
      </div>
    </form>
  </AuthLayout>
</template>

<style scoped>
.bg-adaptive {
  background-color: #ffffff;
}

.img-small {
  max-width: 100px;
}
</style>