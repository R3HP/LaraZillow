<template>
    <div class="mb-4">
        <Link :href="route('realtor.listing.index')">← Go back to Listings</Link>
    </div>

    <section class="flex flex-col-reversed md:grid md:grid-cols-12 gap-4 pb-8">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>
        <div v-else class="md:col-span-7 flex flex-col gap-4">
            <Offer v-for="offer in listing.offers" class="mb-4" :key="offer.id" :offer="offer"
                :listing-price="listing.price" :is-sellable="listing.sold_at == null" />
            <!-- <div v-for="offer in listing.offers" :key="offer.id" :offer="offer" :listing-price="listing.price">{{ offer }}</div> -->
        </div>
        <div class="md:col-span-5">
            <Box >
                <template #header?>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" />
                <ListingItemComponent :listing="listing" />

            </Box>
        </div>

    </section>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Box from '../Listing/components/ui/box.vue';
import Price from '../Listing/components/price.vue';
import ListingSpace from '../Listing/components/listing_space.vue';
import ListingItemComponent from '../Listing/components/listing_item_component.vue';
import { computed } from 'vue';
import Offer from './Components/offer.vue';

const props = defineProps({
    listing: Object
})

const hasOffers = computed(() => props.listing.offers.length)
</script>