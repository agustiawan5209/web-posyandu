<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'relative flex items-center space-x-4 rounded-xl bg-gradient-to-r from-primary to-green-400 px-4 py-3 text-white'
        : 'group flex items-center space-x-4 rounded-md px-4 py-3 text-gray-600'
);
</script>

<template>
    <Link :href="href" :class="classes">

        <slot name="icon" />
        <slot />
    </Link>
</template>
