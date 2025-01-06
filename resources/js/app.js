import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import Layout from './Layouts/Layout.vue'

import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js'
import 'bootstrap-icons/font/bootstrap-icons.css'

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    
    // Assign layout
    const page = pages[`./Pages/${name}.vue`].default
    page.layout = page.layout || Layout

    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})