<template>
  <div class="dark:bg-gray-500">
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-grey-900">
      <div class="container mx-auto dark:bg-gray-600">
        <nav class="p-4 flex items-center justify-between">
          <div class="text-lg font-medium">
            <Link :href="route('listing.index')">Listings</Link>
          </div>
          <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
            <Link :href="route('listing.index')">LaraZillow</Link>
          </div>
          <div class="flex items-center gap-4">
            <Link v-if="notificationCount" :href="route('notification.index')" class="relative text-gray-500 pr-2 py-2 text-lg">
              🔔
              <div
                class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center ">
                {{ notificationCount }}
              </div>
            </Link>
            <div v-if="user" class="text-sm text-gray-500">
              <Link :href="route('realtor.listing.index')">{{ user.name }}</Link>
            </div>
            <Link v-else :href="route('login.create')" class="text-sm text-gray-500">Sign-In</Link>
            <div class="btn-primary">
              <Link :href="route('realtor.listing.create')">+ New Listing</Link>
            </div>
            <Link v-if="user" :href="route('logout')" method="DELETE" as="button">Logout</Link>
          </div>
        </nav>
      </div>
    </header>

    <main class="container mx-auto px-4">
      <div v-if="newSuccessMessage" class="my-4 border shadow-sm border-green-500 bg-green-300 p-2 rounded">
        {{ newSuccessMessage }}
      </div>
      <slot>Default</slot>
    </main>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
const page = usePage();

const newSuccessMessage = computed(() => page.props.value.flash.success,);

const user = computed(() => page.props.value.user);

const notificationCount = computed(() => Math.min(page.props.value.user.notificationCount, 9),)

</script>