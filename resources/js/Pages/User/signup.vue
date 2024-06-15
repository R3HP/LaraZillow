<template>
    <form  @submit.prevent="signup">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="name">Your Name</label>
                <input id="name" type="text" class="input" v-model="form.name"/>
                <div class="inpur-error">{{ form.errors.name }}</div>
            </div>
            <div>
                <label class="label" for="email">Email</label>
                <input id="email" type="text" class="input" v-model="form.email"/>
                <div class="inpur-error">{{ form.errors.email }}</div>
            </div>
            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <input id="password" type="password" class="input" v-model="form.password"/>
                <div class="inpur-error">{{ form.errors.password }}</div>
            </div>
            <div class="mt-4">
                <label class="label" for="password_confirmation">Password Confirmation</label>
                <input id="password_confirmation" type="password" class="input" v-model="form.password_confirmation"/>
            </div>
            <div>
                <Link class="mt-4 text-xs text-gray-500" :href="route('login.create')">Already A Member?Login.</Link>
            </div>
            <div class="mt-4">
                <button class="btn-primary w-full">Submit</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm,Link } from '@inertiajs/inertia-vue3';

const form = useForm({
    name:null,
    email:null,
    password:null,
    password_confirmation:null
});

const signup = () => {
    form.post(route('user.store'))
}

</script>