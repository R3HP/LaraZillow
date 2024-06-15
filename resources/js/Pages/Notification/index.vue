<template>
    <div class="flex flex-col">
        <section v-if="notificationsPaginator.data.length">

            <div v-for="notification in notificationsPaginator.data" :key="notification.id"
                class="border p-4 flex items-center justify-between">
                <div>
                    <span v-if="notification.type === 'App\\Notifications\\OfferMadeNotification'">
                        Offer
                        <Price :price="notification.data.amount" /> for
                        <Link :href="route('realtor.listing.show', { listing: notification.data.listing_id })"
                            class="text-indigo-600 dark:text-indigo-400">listing</Link> was made
                    </span>
                </div>
                <div>
                    <Link :href="route('notification.seen', { notification: notification })" as="button" method="put"
                        v-if="!notification.read_at" class="btn-outline text-xs font-medium uppercase">
                    Mark as read
                    </Link>
                </div>
            </div>
        </section>
        <section v-else>
            <EmptyState>
                No Notifs
            </EmptyState>
        </section>
        <section v-if="notificationsPaginator.links.length > 3" class="w-full flex justify-center mt-4 mb-4">

            <Pagination :links="notificationsPaginator.links" />
        </section>
    </div>
</template>

<script setup>
import EmptyState from '../../Layouts/empty_state.vue';
import Box from '../Listing/components/ui/box.vue';
import Price from '../Listing/components/price.vue';
import Pagination from '../Listing/components/ui/pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';


const props = defineProps({
    'notificationsPaginator': Object
})

// console.log(props);

</script>