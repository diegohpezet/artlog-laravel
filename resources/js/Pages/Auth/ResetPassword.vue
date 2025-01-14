<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthLayout from './Layout/AuthLayout.vue';

const props = defineProps({ token: String, email: String });

const form = useForm({
  token: props.token,
  email: props.email,
  password: "",
  password_confirmation: ""
})

const submit = () => {
  form.post('/auth/reset-password');
}
</script>

<template>
  <AuthLayout>
    <form @submit.prevent="submit">
      <h3 class="text-center text-md-start mb-4 text-uppercase">Reset password</h3>
      <div class="mb-3 d-none">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" v-model="form.email">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" v-model="form.password">
      </div>

      <div class="mb-3">
        <label for="password_confirmation" class="form-label">Repeat password</label>
        <input type="password" class="form-control" id="password_confirmation" v-model="form.password_confirmation">
      </div>

      <button type="submit" class="btn btn-dark w-100 my-3" :disabled="form.processing">Submit</button>
    </form>
  </AuthLayout>
</template>