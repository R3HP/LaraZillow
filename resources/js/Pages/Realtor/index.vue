<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-8">
        <RealtorFilters :filters="filters" />
    </section>
    <section v-if="paginator.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in paginator.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{ 'opacity-25': listing.deleted_at }">
                    <div v-if="listing.sold_at != null"
                        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2">
                        sold
                    </div>
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingItem :listing="listing" />
                </div>
                <section>
                    <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                        <!-- <Link class="btn-outline text-xs font-medium">Preview</Link> -->
                        <a :href="route('listing.show', { listing: listing.id })" target="_blank"
                            class="btn-outline text-xs font-medium">Preview</a>
                        <Link :href="route('realtor.listing.edit', { listing: listing.id })"
                            class="btn-outline text-xs font-medium">Edit</Link>
                        <span>
                            <Link v-if="listing.deleted_at" class="btn-outline text-xs font-medium"
                                :href="route('realtor.listing.destroy', { 'listing': listing.id })" method="Delete"
                                as="button">
                            Delete
                            </Link>
                            <Link v-else class="btn-outline text-xs font-medium"
                                :href="route('realtor.listing.restore', { 'listing': listing.id })" method="" as="button">
                            Restore
                            </Link>
                        </span>
                    </div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">
                        <Link class="btn-outline text-xs font-medium block w-full text-center"
                            :href="route('realtor.listing.image.create', { 'listing': listing })">Images ({{
                                listing.images_count }})</Link>
                    </div>
                    <div class="mt-2 text-gray-600 dark:text-gray-300">
                        <Link class="btn-outline text-xs font-medium block w-full text-center"
                            :href="route('realtor.listing.show', { 'listing': listing })">Offers ({{ listing.offers_count
                            }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <section v-else>
        <EmptyState>
            No Listings
        </EmptyState>
    </section>
    <section>
        <div v-if="paginator.data.length" class="w-full flex justify-center mt-8 mb-20 pb-20">
            <pagination :links="paginator.links" />
        </div>
    </section>
</template>

<script setup>
import Box from "../Listing/components/ui/box.vue";
import Price from "../Listing/components/price.vue";
import ListingSpace from "../Listing/components/listing_space.vue";
import ListingItem from "../Listing/components/listing_item_component.vue";
import RealtorFilters from "./Components/realtors_filters.vue";
import Pagination from "../Listing/components/ui/pagination.vue";
import { Link } from "@inertiajs/inertia-vue3";
import EmptyState from "../../Layouts/empty_state.vue";

defineProps({
    'paginator': Object,
    'filters': Array
});


</script>