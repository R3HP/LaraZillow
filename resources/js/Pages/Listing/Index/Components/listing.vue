<template>
    <Box>
        <Link :href="route('listing.show', { listing: listing.id })">
        <div class="flex items-center gap-1">
            <Price class="text-2xl font-bold" :price="listing.price" />
            <div class="text-xs text-gray-500">
                <Price :price="monthlyPayment" /> pm
            </div>
        </div>
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingTile :listing="listing" class="text-gray-500" />
        </Link>
    </Box>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import ListingTile from "../../components/listing_item_component.vue";
import ListingSpace from "../../components/listing_space.vue";
import Box from "../../../Listing/components/ui/box.vue"
import Price from "../../components/price.vue";
import { useMonthlyPayment } from "../../../../Composables/useMonthlyPayment";

const props = defineProps({
    listing: Object
});

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25)

</script>