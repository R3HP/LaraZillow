<template>
    <Box>
        <template #header>Upload Your Images</template>
        <form @submit.prevent="submit">
            <section class="flex flex-row gap-5 items-center p-8 pb-10">
                <input type="file"
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
                    multiple @input="addImages" />
                <button class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" type="submit"
                    :disabled="!canUpload">Submit</button>
                <button class="btn-outline" type="reset" @click="reset">Reset</button>
            </section>
        </form>
        <div v-if="form.errors" class="p-8 flex flex-col">
            <div v-for="(error,index) in imageErrors" :key="index" >
                <span class="inpur-error" >{{ index }},{{ error }} </span>
            </div>
        </div>
    </Box>

    <Box v-if="listing.images.length" class="mt-6">
        <template #header?>Images</template>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 justify-between">
            <Box v-for="image in listing.images" :key="image.id" class="flex flex-wrap gap-2">
                <img :src="image.src" class="rounded-md" />
                <Link :href="route('realtor.listing.image.destroy',{ listing:listing.id,image:image.id})" as="button" method="delete" class="btn-primary w-full">
                Delete</Link>
            </Box>
        </div>
    </Box>
</template>

<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import Box from '../../Listing/components/ui/box.vue';
import { Inertia } from '@inertiajs/inertia';
import Nprogress from 'nprogress';

const props = defineProps({
    listing: Object
});

const imageErrors = computed(() => Object.values(form.errors));

Inertia.on('progress', (event) => {
    if (event.detail.progress.percentage) {
        Nprogress.set((event.detail.progress.percentage / 100) * 0.90)
    }
});

console.log(props.listing);

const canUpload = computed(() =>
    form.images.length
)

const form = useForm({
    images: []
});


const addImages = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
}

const submit = () => {
    form.post(route('realtor.listing.image.store', { listing: props.listing.id }), {

        onSuccess: () => reset()
    })
}

const reset = () => {
    form.reset('images')
}


</script>