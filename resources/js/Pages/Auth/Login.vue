<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AuthLayout from './Layout/AuthLayout.vue';

defineProps({ errors: Object });

const form = useForm({
  email: "",
  password: "",
});

const submit = () => {
  form.post('/auth/login');
};
</script>

<template>
  <AuthLayout>
    <form @submit.prevent="submit" class="w-100">
      <h3 class="text-center text-md-start mb-4 text-uppercase">Share on ArtLog</h3>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" class="form-control" placeholder="Mail" aria-label="Mail" v-model="form.email">
        </div>
      </div>

      <div class="mb-3">
        <div class="input-group">
          <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
          <input type="password" class="form-control" placeholder="Password" aria-label="Password"
            v-model="form.password">
        </div>
      </div>

      <div class="text-center">
        <span class="text-danger">{{ errors.default }}</span>
      </div>

      <button class="btn btn-dark w-100 my-3" type="submit">
        Submit
      </button>

      <div class="text-center">
        <Link href="/auth/forgot-password">Forgot password?</Link>
      </div>
    </form>

    <hr class="w-100">

    <p class="text-center text-muted">Or login using</p>
    <div class="text-center">
      <div>
        <a href="/auth/google/redirect" class="btn btn-google rounded mb-3"><i class="bi bi-google me-3"></i>Google</a>
      </div>
      <div>
        <a href="/auth/facebook/redirect" class="btn btn-facebook rounded mb-3"><i class="bi bi-facebook me-3"></i>Facebook</a>
      </div>
    </div>

    <div class="text-center botder-top pt-3">
      <Link href="/auth/register">Don't have an account?</Link>
    </div>
  </AuthLayout>
</template>

<style scoped>
.btn-google {
  background-color: #dd4b39;
  color: white;
  padding: .4rem 2rem;
  border: none
}

.btn-facebook {
  background-color: #3b5998;
  color: white;
  padding: .4rem 1.5rem;
  border: none
}
</style>