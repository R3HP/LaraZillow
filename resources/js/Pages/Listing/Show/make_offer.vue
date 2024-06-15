<template>
    <Box>
        <template #header>Make An Offer</template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="form.amount" type="number" class="input" />
                <input v-model.number="form.amount" type="range" :min="min" :max="max" step="10000"
                    class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />
                <button type="submit" class="w-full btn-primary">Make Offer</button>
                <!-- <div v-if="form.errors">
                    <span class="inpur_error">{{ from.errors }}</span>
                </div> -->
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Box from '../components/ui/box.vue';
import Price from '../components/price.vue';
import { computed, watch } from 'vue';
import { debounce } from 'lodash';
const props = defineProps({
    price: Number,
    listingId: Number
})

const form = useForm({
    amount: props.price,
});

const makeOffer = () => {
    form.post(route('listing.offer.store', { listing: props.listingId }))
}

const difference = computed(() => form.amount - props.price);

const min = computed(() => Math.round(props.price / 2))
const max = computed(() => Math.round(props.price * 2))

const emit = defineEmits(['offerUpdated']);

watch(() => form.amount, debounce((value) => emit("offerUpdated", value), 100),)

</script>