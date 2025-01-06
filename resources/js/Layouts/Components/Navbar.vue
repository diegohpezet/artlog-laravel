<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import Searchbar from './Searchbar.vue';

const page = usePage()
const user = computed(() => page.props.auth.user)
</script>

<template>
  <nav>
    <nav class="navbar navbar-expand-md p-0">
      <div class="container-fluid border-bottom py-2 py-sm-0">
        <Link class="navbar-brand d-none d-sm-block" href="/">
          <img :src="'/assets/images/logo.png'" class="img-responsive" width="50" height="50" />
        </Link>

        <Searchbar />

        <button class="navbar-toggler ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasDarkNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
          aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body navbar-collapse">
            <ul v-if="user" class="navbar-nav justify-content-end flex-grow-1 pe-3">
              
              <li class="nav-item">
                <Link class="nav-link" href="/"><i class="bi bi-house d-md-none"></i> Home</Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" :href="'/users/' + user.username"><i class="bi bi-person d-md-none"></i>
                  Profile
                </Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" type="button" href="/posts/create">
                  <i class="bi bi-upload d-md-none"></i> Upload content!
                </Link>
              </li>
              <li class="nav-item">
                <Link class="nav-link" href="/auth/logout"><i class="bi bi-box-arrow-left d-md-none"></i>
                  Logout
                </Link>
              </li>
              
            </ul>
            
            <ul v-else class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <Link class="nav-link" href="/auth/login">Sign in to upload content!</Link>
              </li>
            </ul>
            
            <div class="d-block d-md-none">
              <hr />
              <p>Made with ❤️ by <a href="https://github.com/diegohpezet">diegohpezet</a></p>
            </div>

          </div>
        </div>
      </div>
    </nav>
  </nav>
</template>