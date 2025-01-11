<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ user: Object });

const page = usePage();
const currentUser = page.props.auth.user;

const socialInfo = ref({
  follows: props.user.follows.length,
  followers: props.user.followers.length,
});

const isFollowed = ref(props.user.followers.some(follower => follower.follower_id === currentUser?.id))

const toggleFollow = async () => {
  const response = await fetch(`/users/${props.user.id}/follow`, {
    method: isFollowed.value ? 'DELETE' : 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
    }
  });

  if (response.ok) {
    const data = await response.json();
    console.log("data", data);
    socialInfo.value = {
      ...socialInfo.value,
      followers: data.follower_count
    }
    isFollowed.value = !isFollowed.value;
  }
}

</script>

<template>
  <div class="row">

    <div class="col-3">
      <figure class="position-relative">
        <img :src="user.avatar" alt="" class="rounded-circle shadow-sm border border-3 object-fit-cover"
          style="width: 140px; height: 140px;">
        <Link v-if="currentUser?.id === user.id" :href="'/users/' + user.username + '/edit'" class="btn btn-light border rounded-circle edit-btn">
          <i class="bi bi-pencil-fill my-2"></i>
        </Link>
      </figure>
      
    </div>
    <div class="col mt-3">

      <div class="d-flex justify-content-center">
        <p class="text-muted">
          {{ socialInfo.follows }} 
          <Link :href="'/users/' + user.username + '/following'" class="text-decoration-none text-muted">Following</Link>
           · 
          {{ socialInfo.followers }}
          <Link :href="'/users/' + user.username + '/followers'" class="text-decoration-none text-muted">Followers</Link>
        </p>
      </div>

      <div class="d-flex justify-content-center mt-3" id="socialActions">
        <button v-if="currentUser?.id === user.id" class="btn btn-light mx-2">
          <i class="bi bi-gear-fill me-2"></i>
          Settings
        </button>
        
        <button v-else-if="!isFollowed" class="btn btn-primary mx-2" @click="toggleFollow">
          <i class="bi bi-person-plus-fill me-2"></i>
          Follow
        </button>

        <button v-else class="btn btn-secondary mx-2" @click="toggleFollow">
          <i class="bi bi-person-check-fill me-2"></i>
          Following
        </button>
        <button class="btn btn-light mx-2"><i class="bi bi-share-fill me-2"></i>Share</button>
      </div>

    </div>
  </div>

  <div>
    <article>
      <h3 class="fw-bold">@{{ user.username }}</h3>
      <p>No description provided yet</p>
    </article>
  </div>
</template>

<style scoped>
.edit-btn {
  position: absolute;
  bottom: 0;
  right: 20;
}
</style>