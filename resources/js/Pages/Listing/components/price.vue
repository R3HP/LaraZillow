<template>
    <span> {{ priceFormatted }}</span>
</template>

<script setup>
import { computed } from 'vue';
const props = defineProps({
    price: [Number, String]
});

const priceFormatted = computed(() => {
    return Number(props.price).toLocaleString('en-US', {
        style : 'currency',
        currency : 'USD',
        maximumFractionDigits : 0
    })
})
</script>