<template>
    <form>
        <div class="mt-4 mb-4 flex flex-wrap gap-4">
            <div class="flex flex-nowrap items-center gap-2">
                <input v-model="filterForm.deleted" id="deleted" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="deleted">Deleted</label>
            </div>
        </div>
        <div>
            <select v-model="filterForm.by" class="input-filter-left w-40">
                <option value="created_at">ByTime</option>
                <option value="price">ByPrice</option>
            </select>
            <select v-model="filterForm.order" class="input-filter-right w-48">
                <option v-for="sortOption in sortOptions" :value="sortOption.value">{{ sortOption.label }}</option>
            </select>
        </div>
    </form>
</template>

<script setup>

import { watch, reactive, computed } from 'vue';
import { debounce } from 'lodash'
import { Inertia } from '@inertiajs/inertia';
// import { router } from '@inertiajs/vue3';

const props = defineProps({
    'filters' : Array,
});


const orderOptions = {
    'created_at': [
        {
            'label': 'Latest',
            'value': 'desc'
        },
        {
            'label': 'Oldest',
            'value': 'asc'
        },
    ],
    'price': [
        {
            'label': 'Most Expensive',
            'value': 'desc'
        },
        {
            'label': 'Cheapest',
            'value': 'asc'
        }
    ]
}

const sortOptions = computed(() => orderOptions[filterForm.by]);


const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    by : props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc'
});

watch(filterForm, debounce(() => {
    console.log('req was made');
    console.log(filterForm);
    Inertia.get(route('realtor.listing.index'), filterForm, {
        preserveState: true,
        preserveScroll: true
    })
}, 1000));

</script>