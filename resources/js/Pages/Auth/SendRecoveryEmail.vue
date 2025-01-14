<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
  email: "",
});

const message = ref("");
const submit = () => {
  form.post('/auth/send-recovery-email', {
    onSuccess: () => {
      form.reset();
      message.value = "We've emailed you instructions for setting your password, if an account exists with the email you entered. You should receive them shortly.";
    }
  });
};
</script>

<template>
  <div class="vh-100 d-flex align-items-center justify-content-center bg-adaptive">
    <div class="p-4 position-relative w-100 d-flex flex-column align-items-center card-md" style="max-width: 450px;">
      <form @submit.prevent="submit" class="w-100">
        <h3 class="text-center text-md-start mb-4 text-uppercase">Account recovery</h3>

        <div class="mb-3">
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="email" class="form-control" placeholder="Mail" aria-label="Mail" v-model="form.email">
          </div>
          <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
        </div>

        <span class="text-muted text-center">{{ message }}</span>

        <button class="btn btn-dark w-100 mt-3" type="submit" :disabled="form.processing">
          Send recovery email
        </button>
      </form>
    </div>
  </div>
</template>

<style scoped>
.bg-adaptive {
  background-color: #ffffff;
}

h3 {
  letter-spacing: 3px;
  font-size: 1.5rem;
}

@media (min-width: 768px) {
  .bg-adaptive {
    background-color: #f8f9fa;
  }

  .card-md {
    padding: 2rem;
    box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2);
    background: #ffffff;
  }
}
</style>