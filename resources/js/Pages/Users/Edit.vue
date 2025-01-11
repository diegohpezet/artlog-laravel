<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ user: Object });

const form = useForm({
  avatar: props.user.avatar,
  username: props.user.username,
});

const imageUrl = ref(props.user.avatar);
const handleImage = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.avatar = file;
    imageUrl.value = URL.createObjectURL(file);
  }
};


const submit = () => {
  const formData = new FormData();
  formData.append('username', form.username);

  if (form.avatar) {
    formData.append('avatar', form.avatar);
  }

  form.post('/users/' + props.user.id, {
    data: formData
  });
};

</script>

<template>
  <div class="container mt-3">
    <h1>Edit profile</h1>
    <form @submit.prevent="submit" enctype="multipart/form-data">
      <div class="row">
        <div class="col-12 col-md-4 ">
          <!--Profile picture-->
          <div class="mb-3">
            <label for="avatar" class="form-label d-flex justify-content-center">
              <img :src="imageUrl" alt="User avatar" class="profile-label" />
            </label>
            <input type="file" class="form-control d-none" id="avatar" @change="handleImage">
            <span class="text-danger">{{ form.errors.avatar }}</span>
          </div>
        </div>

        <div class="col-12 col-md-8">
          <!--Username and description-->
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
        </div>
      </div>

      <button type="submit" class="btn btn-dark w-100">Submit</button>
    </form>
  </div>
</template>

<style scoped>
.profile-label {
  width: 175px;
  height: 175px;
  border-radius: 50%;
  cursor: pointer;
  object-fit: cover;
}

.profile-label:hover {
  opacity: 0.8;
}
</style>