<script setup>
import { Head, Link } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue'

import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref, defineProps } from 'vue'
const props = defineProps({
    puskesmas: {
        type: Object,
        default: () => ({}),
    },
})

</script>

<template>
    <Head title="Jadwal Puskesmas" />
    <HomeLayout>

        <div class="container mx-auto overflow-hidden md:px-6 2xl:px-0 xl:max-w-7xl relative">
            <section class="p-6 dark:bg-gray-100 dark:text-gray-800">
                <div class="container grid gap-6 mx-auto text-center lg:grid-cols-2 xl:grid-cols-5">
                    <div class="w-full px-6 py-16 rounded-md sm:px-12 md:px-16 xl:col-span-2 dark:bg-gray-50">
                        <span class="block mb-2 dark:text-emerald-600">Mamba design system</span>
                        <h1 class="text-5xl font-extrabold dark:text-gray-900">Build it with Mamba</h1>
                        <p class="my-8">
                            <span class="font-medium dark:text-gray-900">Modular and versatile.</span>Fugit vero facilis dolor sit neque cupiditate minus esse accusamus cumque at.
                        </p>
                        <form novalidate="" action="" class="self-stretch space-y-3">
                            <div>
                                <label for="name" class="text-sm sr-only">Your name</label>
                                <input id="name" type="text" placeholder="Your name" class="w-full rounded-md focus:ring focus:dark:ring-emerald-600 dark:border-gray-300">
                            </div>
                            <div>
                                <label for="lastname" class="text-sm sr-only">Email address</label>
                                <input id="lastname" type="text" placeholder="Email address" class="w-full rounded-md focus:ring focus:dark:ring-emerald-600 dark:border-gray-300">
                            </div>
                            <button type="button" class="w-full py-2 font-semibold rounded dark:bg-emerald-600 dark:text-gray-50">Join the waitlist</button>
                        </form>
                    </div>
                    <img src="https://source.unsplash.com/random/480x360" alt="" class="object-cover w-full rounded-md xl:col-span-3 dark:bg-gray-500">
                </div>
            </section>
        </div>
    </HomeLayout>
</template>


<style>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.fade-enter-active {
    transition: all 0.3s ease-out;
  }

  .fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .fade-enter-from {
    transform: translateX(-100%);
    opacity: 0;
  }
  .fade-leave-to {
    transform: translateX(100%);
    opacity: 0;
  }
</style>
