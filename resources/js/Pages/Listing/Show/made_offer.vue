<template>
    <Box>
        <template #header>Offer Is Already Made</template>
        <div class="flex flex-row md:flex-col">
            <div class="flex flex-col md:flex-row justify-between ">
                <span>Offer Submitted At:</span>
                <span>{{ offerCreateTime }}</span>
            </div>
            <div class="flex flex-col md:flex-row justify-between ">
                <span>Offer Value:</span>
                <Price :price="offer.amount" />
            </div>
            <div class="flex flex-col md:flex-row justify-between ">
                <span>Offer Status:</span>
                <span>{{ offerStatus }}</span>                
            </div>

        </div>
    </Box>
</template>

<script setup>
import Price from '../components/price.vue';
import Box from '../components/ui/box.vue';
import { computed } from 'vue';
const props = defineProps(
    {
        offer: Object
    }
)

console.log(props.offer);

const offerCreateTime = computed(() => 
    new Date(props.offer.created_at).toDateString()  
)



const offerStatus = computed(() => {
    if (props.offer.rejected_at) {
        return false;
    }else if(props.offer.accepted_at){
        return true;
    }
    return null;
}) 
</script>