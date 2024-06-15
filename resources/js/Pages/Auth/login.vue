<template>
    <form  @submit.prevent="login">
        <div class="w-1/2 mx-auto">
            <div>
                <label class="label" for="email">Email</label>
                <input id="email" type="text" class="input" v-model="form.email"/>
                <div class="inpur-error">{{ form.errors.email}}</div>
            </div>
            <div class="mt-4">
                <label class="label" for="password">Password</label>
                <input id="password" type="password" class="input" v-model="form.password"/>
                <div class="inpur-error">{{ form.errors.password}}</div>
            </div>
            <div>
                <Link class="mt-4 text-xs text-gray-500" :href="route('user.create')">Don't Have An Account?SignUp.</Link>
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
    email:null,
    password:null
});
const login = () => {
    form.post(route('login.store'))
}

</script>