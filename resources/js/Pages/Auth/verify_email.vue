<template>
    <div>
        <b>You Should Verify Your Email To Access This Page</b>
    </div>
    <div>
        <Link :href="route('verification.send')" as="button" method="post" class="primary-btn">Resend</Link>
    </div>

</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>