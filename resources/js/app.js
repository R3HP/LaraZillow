import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import MainLayout from "./Layouts/main_layout.vue";
import { ZiggyVue } from "Ziggy";
import '../css/app.css'
// import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';


createInertiaApp({
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 5,

    // The color of the progress bar...
    color: '#29d',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: false,

  },
  resolve: name => {
    console.log('hello')
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    console.log('bello')
    console.log(pages);
    console.log(name);
    const page =  pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || MainLayout
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      // .component('InertiaHead', Head)
      // .component('InertiaLink', Link)
      .mount(el)
  },
})