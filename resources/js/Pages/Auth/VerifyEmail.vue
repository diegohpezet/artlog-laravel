<script setup>
import { useForm } from '@inertiajs/vue3';
import AuthLayout from './Layout/AuthLayout.vue';

const form = useForm({});

const submit = () => {
  form.post('/auth/email/verification-notification');
};
</script>

<template>
  <AuthLayout>
    <div class="mb-4 text-secondary">
      <p>Thanks for signing up! </p>

      <p>Before getting started, could you verify your email address by clicking on the link we
        just emailed to you? </p>

      <p>If you didn't receive the email, we will gladly send you another.</p>
    </div>

    <form @submit.prevent="submit">
      <div class="mb-3">
        <button class="btn btn-dark" type="submit" :disabled="form.processing">
          Resend Verification Email
        </button>
      </div>
    </form>
  </AuthLayout>
</template>