<template>
    <form @submit.prevent="submit">
        <div class="flex flex-wrap mb-8 mt-4 gap-3">
            <div class="flex flex-nowrap items-center">
                <input v-model.number="form.priceFrom" class="filter-input-left" placeholder="Price From" type="text" />
                <input v-model.number="form.priceTo" class="filter-input-right" placeholder="Price To" type="text" />

            </div>
            <div class="flex flex-nowrap items-center">
                <select v-model="form.beds" class="filter-input-left w-28">
                    <option :value="null">Beds</option>
                    <option v-for="index in 5" :key="index" :value="index">{{ index }}</option>
                    <option value="6+">6+</option>
                </select>
                <select v-model="form.baths" class="filter-input-right w-28">
                    <option :value="null">Baths</option>
                    <option v-for="index in 5" :key="index" :value="index">{{ index }}</option>
                    <option value="6+">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input v-model.number="form.areaFrom" class="filter-input-left" placeholder="Area From" type="text" />
                <input v-model.number="form.areaTo" class="filter-input-right" placeholder="Area To" type="text" />
            </div>
            <div class="flex flex-nowrap items-center gap-2">
                <button type="submit" class="btn-normal">Filter</button>
                <button type="reset" @click="clear">Clear</button>
            </div>

        </div>

    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    filters : Object
})

const form = useForm({
    'priceFrom': props.filters.priceFrom ?? null,
    'priceTo': props.filters.priceTo ?? null,
    'beds': props.filters.beds ?? null,
    'baths': props.filters.baths ?? null,
    'areaFrom': props.filters.areaFrom ?? null,
    'areaTo': props.filters.areaTo ?? null
})

const submit = () => form.get(route('listing.index'), {
    preserveScroll: true,
    preserveState: true,
})

const clear = () => {
    form.priceFrom = null;
    form.priceTo = null;
    form.beds = null;
    form.baths = null;
    form.areaFrom = null;
    form.areaTo = null;
    submit()
}

</script>