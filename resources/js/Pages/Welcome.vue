<script setup>
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>

    <Head title="Welcome" />

    <nav class="flex items-center justify-between flex-wrap bg-primary p-6 z-50">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <span class="font-semibold text-xl tracking-tight">Puskesmas Bonto Ujung</span>
        </div>
        <div class="block lg:hidden">
            <button
                class="flex items-center px-3 py-2 border rounded text-green-200 border-green-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-green-200 hover:text-white mr-4">
                    Pasien & Pengunjung
                </a>
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-green-200 hover:text-white mr-4">
                    Jadwal
                </a>
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-green-200 hover:text-white mr-4">
                    Emergensi 1-500-911
                </a>
                <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-green-200 hover:text-white mr-4">
                    Informasi
                </a>
            </div>
            <div class="flex flex-wrap justify-between gap-4">
                <Link :href="route('login')"
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                Masuk</Link>
                <Link :href="route('register')"
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                Daftar</Link>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <Hero />
    <!-- Hero Section -->
    <!-- Layanan -->
    <Layanan />
    <!-- Layanan -->


    <footer class="w-full bg-gray-100 dark:bg-gray-900 py-16">
        <div class="md:px-12 lg:px-28">
            <div class="container m-auto space-y-6 text-gray-600 dark:text-gray-300">
                <img src="images/logo.svg" alt="logo tailus" class="m-auto w-40" />
                <ul role="list" class="flex flex-col items-center justify-center gap-4 py-4 sm:flex-row sm:gap-8">
                    <li role="listitem"><a href="#" class="hover:text-primary">Home</a></li>
                    <li role="listitem"><a href="#" class="hover:text-primary">Features</a></li>
                    <li role="listitem"><a href="#" class="hover:text-primary">Get started</a></li>
                    <li role="listitem"><a href="#" class="hover:text-primary">About us</a></li>
                </ul>
                <div class="m-auto flex w-max items-center justify-between space-x-4">
                    <a href="tel:+243996660436" aria-label="call">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="m-auto w-5"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z">
                            </path>
                        </svg>
                    </a>
                    <a href="mailto:hello@mail.com" aria-label="send mail">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="m-auto w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" title="facebook" target="blank" aria-label="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="m-auto w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" title="linkedin" target="blank" aria-label="linkedin">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="m-auto w-5"
                            viewBox="0 0 16 16">
                            <path
                                d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="text-center">
                    <span class="text-sm tracking-wide">Copyright © tailus <span id="year"></span> | All right
                        reserved</span>
                </div>
            </div>
        </div>
    </footer>

</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
