<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <HomeLayout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 py-3 sm:py-10 sm:pt-0 bg-white">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border">
                <div class=" w-full flex justify-center">
                    <Link href="/">
                    <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
                    </Link>
                </div>

                <slot />
            </div>
        </div>
    </HomeLayout>
</template>
