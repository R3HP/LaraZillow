<template>
  <div>Index</div>
  <div>This is Message {{ message }}</div>
</template>



<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  message: String,
});
</script>


<script>
// import MainLayout from "../../Layouts/main_layout.vue";
// export default {
//   layout: MainLayout,
// };
</script>
