<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar/Sidebar.vue';

const showingNavigationDropdown = ref(false);
</script>


<template>
    <div class="aside-anime">

        <div class="mt-8 text-center">
            <img :src="'/images/logo/logo-dark.png'" alt=""
                class="m-auto h-10 w-10 rounded-md object-cover lg:h-28 lg:w-28" />
            <h5 class="mt-4  text-xl font-semibold text-gray-600 lg:block">{{ $page.props.auth.user.name }}
            </h5>
            <span class=" text-gray-400 lg:block">{{ $page.props.auth.role.name }}</span>
        </div>

        <ul class="mt-8 space-y-2 tracking-wide">
            <li>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    <svg class="-ml-1 h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M6 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V8ZM6 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2v-1Z"
                            class=" fill-current"
                            :class="route().current('dashboard') ? 'text-green-400' : 'text-gray-300 group-hover:text-green-300'">
                        </path>
                        <path d="M13 8a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2V8Z"
                            class="fill-current"
                            :class="route().current('dashboard') ? 'text-green-200 group-hover:text-green-300' : 'text-gray-600 group-hover:text-green-600'">
                        </path>
                        <path d="M13 15a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-1Z"
                            class="fill-current group-hover:text-primary"></path>
                    </svg>
                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('master')" :active="route().current('master')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path class=" fill-current"
                        :class="route().current('master') ? 'text-green-400' : 'text-gray-300 group-hover:text-green-300'" fill-rule="evenodd"
                            d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z"
                            clip-rule="evenodd" />
                        <path class="fill-current"

                        :class="route().current('master') ? 'text-green-200 group-hover:text-green-300' : 'text-gray-600 group-hover:text-green-600'"
                            d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z" />
                    </svg>
                    <span class="group-hover:text-gray-700 capitalize">Orang Tua</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path  fill-rule="evenodd"
                            d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                            clip-rule="evenodd" />
                        <path class="fill-current "
                        :class="route().current('dashboard') ? 'text-green-200 group-hover:text-green-300' : 'text-gray-600 group-hover:text-green-600'"
                            d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                    <span class="group-hover:text-gray-700 capitalize">Jadwal Imunisasi</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path class="fill-current "
                        :class="route().current('dashboard') ? 'text-green-200 group-hover:text-green-300' : 'text-gray-600 group-hover:text-green-600'"
                            d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    <span class="group-hover:text-gray-700 capitalize">Data Balita Dan Ibu Hamil</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#">
                    <font-awesome-icon :icon="['fas', 'gears']"
                        class="fill-current text-gray-600 group-hover:text-green-600" />
                    <span class="group-hover:text-gray-700 capitalize">setting</span>
                </NavLink>
            </li>
        </ul>
    </div>
    <div class="-mx-6 flex items-center justify-between border-t px-6 pt-4">
        <NavLink :href="route('logout')" method="post" as="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="group-hover:text-gray-700 capitalize">Logout</span>
        </NavLink>
    </div>
</template>
