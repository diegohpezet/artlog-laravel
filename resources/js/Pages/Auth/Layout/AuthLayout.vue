<template>
  <div class="vh-100 d-flex align-items-center justify-content-center bg-adaptive">
    <div class="p-4 position-relative w-100 d-flex flex-column align-items-center card-md" style="max-width: 450px;">
      <slot />
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