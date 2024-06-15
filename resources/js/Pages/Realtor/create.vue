<template>
    <form @submit.prevent="submit">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input v-model.lazy.number="form.beds" type="number"
                    class="input">
                <div v-if="form.errors.beds" class="input-error">
                    {{ form.errors.beds }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Baths</label>
                <input v-model.lazy.number="form.baths" type="number"
                    class="input">
                <div v-if="form.errors.baths" class="input-error">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input v-model.lazy.number="form.area" type="number" class="input">
                <div v-if="form.errors.area" class="input-error">
                    {{ form.errors.area }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label" >City</label>
                <input v-model.lazy.trim="form.city" type="text" class="input">
                <div v-if="form.errors.city" class="input-error">
                    {{ form.errors.city }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">PostCode</label>
                <input v-model.lazy.trim="form.code" type="text" class="input">
                <div v-if="form.errors.code" class="input-error">
                    {{ form.errors.code }}
                </div>
            </div>
            <div class="col-span-4">
                <label class="label">Street</label>
                <input v-model.lazy.trim="form.street" type="text" class="input">
                <div v-if="form.errors.street" class="input-error">
                    {{ form.errors.street }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input v-model.lazy.trim="form.street_nr" type="text" class="input">
                <div v-if="form.errors.street_nr" class="input-error">
                    {{ form.errors.street_nr }}
                </div>
            </div>
            <div class="col-span-6">
                <label class="label">Price</label>
                <input v-model.lazy.number="form.price" type="number" class="input">
                <div v-if="form.errors.price" class="input-error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-6">
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>


<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    beds: null,
    baths: null,
    area: null,
    city: null,
    code: null,
    street: null,
    street_nr: null,
    price: null,
});



const submit = () => form.post(route('realtor.listing.store'))

</script>