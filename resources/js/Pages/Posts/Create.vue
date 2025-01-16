<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const image = ref(null);
const form = useForm({ image: null, description: '' });

const handleImageChange = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.image = file;
    image.value = URL.createObjectURL(file);

  }
};

const submit = () => {
  form.post('/posts', {
    onSuccess: () => {
      form.reset();
      image.value = null;
    },
  });
};
</script>

<template>
  <div class="container">
    <h1 class="my-3 text-center">Share new content!</h1>
    <form @submit.prevent="submit" class="text-center mx-auto image-input">
      <div class="mb-3">

        <label for="image" class="border rounded d-flex align-items-center justify-content-center">
          <div class="text-center text-muted">
            <img v-if="image" :src="image" alt="Preview" class="img-fluid" style="height: 360px;" />
            <div v-else class="d-flex flex-column align-items-center justify-content-center" style="height: 360px;">
              <i class="bi bi-upload" style="font-size: 4rem"></i>
              <p>Upload your picture here</p>
            </div>
          </div>
        </label>

        <input type="file" id="image" class="d-none" accept="image/*" @change="handleImageChange" />

        <span class="text-danger" v-if="form.errors.image">{{ form.errors.image }}</span>
      </div>

      <div :class="'mb-3' + ''">
        <label for="description" class="form-label">Write something about your picture</label>
        <input type="text" class="form-control" id="description" placeholder="This is my wonderful picture!" v-model="form.description">
        <span class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</span>
      </div>

      <button type="submit" class="btn btn-dark w-100" :disabled="form.processing">Submit</button>
    </form>
  </div>
</template>

<style scoped>
@media (min-width: 768px) {
  .image-input {
    width: 400px;
  }
}

@media (min-width: 992px) {
  .image-input {
    width: 500px;
  }
}

img {
  max-width: 100%;
  border-radius: 5px;
  object-fit: contain;
}
</style>
