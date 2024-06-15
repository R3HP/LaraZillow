<template>
    <Box>
        <template #header>Offer #{{ offer.id }} <span v-if="offer.accepted_at"
                class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1">accepeted</span>
        </template>
        <section class="flex items-center justify-between">
            <div>

                <Price :price="offer.amount" />

                <div class="text-gray-500">
                    Difference
                    <Price :price="difference" />
                </div>

                <div class="text-gray-500 text-sm">
                    Made By {{ offer.bidder.name }}
                </div>

                <div class="text-gray-500 text-sm">
                    Made On {{ madeOn }}
                </div>
            </div>
            <div v-if="isSellable">
                <Link class="btn-outline text-xs font-medium" as="button" method="put"
                    :href="route('realtor.offer.accept', { offer: offer.id })">Accept</Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import Price from '../../Listing/components/price.vue';
import Box from '../../Listing/components/ui/box.vue';
import { computed } from 'vue';

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSellable : Boolean
})

const difference = computed(() => props.offer.amount - props.listingPrice)

const madeOn = computed(() => new Date(props.offer.created_at).toString())

// const isSellable = computed(() => props.offer.accepted_at == null && props.offer.rejected_at == null)

</script>