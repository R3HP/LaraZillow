<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 md:gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div v-if="listing.images.length" class="grid grid-cols-3">
                <div v-for="image in listing.images" :key="image.id">
                    <img :src="image.src" />
                </div>
            </div>
            <EmptyState v-else class="text-gray-800">No Images</EmptyState>

        </Box>
        <div class="flex flex-col gap-2 md:col-span-5">
            <Box>
                <template #header>Basic Info</template>
                <Price class="text-2xl font-bold" :price="listing.price" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingTile :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>Monthly Payment</template>
                <div>
                    <label class="label">Interest Rate(% {{ interestRate }})</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer ">
                    <!-- dark:bg-gray-700 -->
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input v-model.number="duration" type="range" min="1" max="30" step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer ">
                    <!-- dark:bg-gray-700 -->

                    <Price :price="monthlyPayment" class="text-3xl" />

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div>
                                <Price :price="paidPrice" class="font-medium" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div>
                                <Price :price="totalInterest" class="font-medium" />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer @offer-updated="paidPrice = $event" v-if="user && !offerMadeByUser" :listing-id="listing.id"
                :price="listing.price" />
            <MadeOffer v-else :offer="offerMadeByUser" />

        </div>

    </div>
</template>


<script setup>

import ListingTile from "./components/listing_item_component.vue";
import ListingSpace from "./components/listing_space.vue";
import Price from "./components/price.vue";
import Box from "./components/ui/box.vue";
import { useMonthlyPayment } from "../../Composables/useMonthlyPayment"
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import MakeOffer from "./Show/make_offer.vue";
import MadeOffer from "./Show/made_offer.vue";
import EmptyState from "../../Layouts/empty_state.vue";
const props = defineProps({
    listing: Object,
    offerMadeByUser: Object
});

const interestRate = ref(2.5)
const duration = ref(25)

const paidPrice = ref(props.listing.price);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(paidPrice, interestRate, duration);

const user = computed(() => usePage().props.value.user)

</script>