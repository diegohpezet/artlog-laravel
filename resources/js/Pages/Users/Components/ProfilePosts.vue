<script setup>
import PicturesGrid from './PicturesGrid.vue';

defineProps({ posts: [Object], likedPosts: [Object] });
</script>

<template>
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="picturesTab" data-bs-toggle="tab" data-bs-target="#pictures-pane"
        type="button" role="tab" aria-controls="pictures-pane" aria-selected="true">Pictures ({{ posts.length }})</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="likedPicturestab" data-bs-toggle="tab" data-bs-target="#liked-pane" type="button"
        role="tab" aria-controls="liked-tab-pane" aria-selected="false">Liked ({{ likedPosts.length }})</button>
    </li>
  </ul>

  <div class="tab-content">

    <!-- User pictures -->
    <div class="tab-pane fade show active" id="pictures-pane" role="tabpanel" aria-labelledby="pictures-tab" tabindex="0">
      <div class="row g-0 mt-3" id="user-pictures">
        <p v-if="posts.length == 0">This user hasn't uploaded any pictures yet</p>
        <PicturesGrid v-else :posts="posts"/>
      </div>
    </div>

    <!-- Liked pictures -->
    <div class="tab-pane fade" id="liked-pane" role="tabpanel" aria-labelledby="liked-tab" tabindex="0">
      <div class="row g-0 mt-3" id="user-liked-pictures">
        <p v-if="posts.length == 0">This user hasn't liked any pictures yet</p>
        <PicturesGrid v-else :posts="likedPosts"/>
      </div>
    </div>

  </div>
</template>