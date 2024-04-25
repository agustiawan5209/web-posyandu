<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Hero from '@/Components/Header/Hero.vue';
import Layanan from '@/Components/Header/Layanan.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, defineProps, onMounted } from 'vue';


const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
const Year = new Date().getFullYear()
const Navigate = ref(false);

</script>

<template>

    <nav class="flex items-center justify-between flex-wrap bg-primary  z-50">
        <div class="flex items-center flex-shrink-0 text-white mr-6 p-6">
            <span class="font-semibold text-xl tracking-tight">UPT Puskesmas Karassing</span>
        </div>
        <div class="block lg:hidden p-6" @click="Navigate = !Navigate">
            <button
                class="flex items-center px-3 py-2 border rounded text-green-200 border-green-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full hidden md:block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <Link :href="route('home')" :class="route().current('home') ? 'text-white hover:text-green-300 border-white ' : 'text-green-200 hover:text-white border-transparent'"
                    class="p-3 block mt-4 lg:inline-block font-medium lg:mt-0 border  rounded-lg ">
                    <font-awesome-icon :icon="['fas','home']"/>
                Beranda
                </Link>
                <Link :href="route('Home.jadwal')"
                :class="route().current('Home.jadwal') ? 'text-white hover:text-green-300 border-white ' : 'text-green-200 hover:text-white border-transparent'"
                    class="p-3 block mt-4 lg:inline-block font-medium lg:mt-0  border  rounded-lg ">
                    <font-awesome-icon :icon="['fas','file-lines']"/>

                Jadwal
                </Link>
                <a href="#" class="p-3 block mt-4 lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white">
                    <font-awesome-icon :icon="['fas', 'square-phone-flip']" />
                    Emergensi 1-500-911
                </a>
                <a href="#" class="p-3 block mt-4 lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white">
                    <font-awesome-icon :icon="['fas', 'circle-info']" />
                    Informasi
                </a>
            </div>
            <div class="flex flex-wrap justify-between gap-4 p-6">
                <Link :href="route('login')"
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                Masuk</Link>
                <Link :href="route('register')"
                    class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                Daftar</Link>
            </div>
        </div>
        <transition name="fade-left">
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto" v-if="Navigate">
                <div class="text-sm lg:flex-grow">
                    <a href="#" class="px-6 block mt-4  lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white mr-4">
                        Pasien & Pengunjung
                    </a>
                    <Link :href="route('Home.jadwal')"
                        class="px-6 block mt-4 lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white mr-4">
                    Jadwal
                    </Link>
                    <a href="#" class="px-6 block mt-4 lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white mr-4">
                        Emergensi 1-500-911
                    </a>
                    <a href="#" class="px-6 block mt-4 lg:inline-block font-medium lg:mt-0 text-green-200 hover:text-white mr-4">
                        Informasi
                    </a>
                </div>
                <div class="flex flex-wrap justify-between gap-4 p-6">
                    <Link :href="route('login')"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                    Masuk</Link>
                    <Link :href="route('register')"
                        class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-primary hover:bg-white mt-4 lg:mt-0">
                    Daftar</Link>
                </div>
            </div>
        </transition>
    </nav>

    <main class="">
        <slot />
    </main>

    <footer class=" divide-y bg-white">
        <div class="container flex flex-col justify-between py-10 mx-auto space-y-8 lg:flex-row lg:space-y-0">
            <div class="lg:w-1/3">
                <a rel="noopener noreferrer" href="#" class="flex justify-center space-x-3 lg:justify-start">
                    <ApplicationLogo class="w-10"/>
                    <span class="self-center text-2xl font-semibold">UPT Puskesmas Karassing</span>
                </a>
            </div>
            <div class="grid grid-cols-2 text-sm gap-x-3 gap-y-8 lg:w-2/3 sm:grid-cols-2">
                <div class="space-y-3">
                    <h3 class="tracking-wide uppercase font-semibold">Jadwal Pelayanan Puskesmas</h3>
                    <ul class="space-y-5">
                        <li>
                            <a rel="noopener noreferrer" href="#">Senin-Kamis : 07.30-15.00 WIB</a>
                        </li>
                        <li>
                            <a rel="noopener noreferrer" href="#">Jumat : 07.30-15.30 WIB</a>
                        </li>
                        <li>
                            <a rel="noopener noreferrer" href="#">Unit Pelayanan Bersalin 24 Jam</a>
                        </li>
                    </ul>
                </div>
                <div class="space-y-3">
                    <h3 class="uppercase">Hubungi Kami</h3>
                    <ul class="space-y-1">
                        <li class="flex gap-4">
                            <font-awesome-icon :icon="['fas', 'location-dot']"/>
                            <span>Ds. Karassing, Kec. Hero Lange-Lange</span>
                        </li>
                        <li class="flex gap-4">
                            <font-awesome-icon :icon="['fas', 'phone']"/>
                            <span>+62 85255814561</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-6 text-sm text-center bg-primary">UPT Puskesmas Karassing© {{ Year }}. All rights reserved.</div>
    </footer>

</template>

<style>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.fade-left-enter-active {
    transition: all 0.3s ease-out;
}

.fade-left-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.fade-left-enter-from {
    transform: translateX(-100%);
    opacity: 0;
}

.fade-left-leave-to {
    transform: translateX(100%);
    opacity: 0;
}
</style>
