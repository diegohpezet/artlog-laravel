<script setup>
import Navbar from './Components/Navbar.vue';
</script>

<template>
  <header>
    <Navbar />
  </header>

  <main>
    <slot>
      <!-- Content -->
    </slot>
  </main>
</template>