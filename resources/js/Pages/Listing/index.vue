<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3 pt-2">
        <Listing v-for="listing in paginator.data" :key="listing.id" :listing="listing" />
    </div>

    <div v-if="paginator.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="paginator.links" />
    </div>
</template>

<script setup>
import Listing from "./Index/Components/listing.vue";
import Filters from "./components/ui/filters.vue";
import Pagination from "./components/ui/pagination.vue";
defineProps({
    paginator: Object,
    filters : Array
})
</script>