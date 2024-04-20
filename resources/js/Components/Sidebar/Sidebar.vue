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

        <ul class="mt-8 space-y-1 tracking-wide text-sm">
            <li>
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" :icon="['fas', 'home']">

                    <span class="-mr-1 font-medium">Dashboard</span>
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('Pegawai.index')" :active="route().current('Pegawai.index') || route().current('Pegawai.create') || route().current('Pegawai.edit')" :icon="['fas', 'user-group']">
                    <span class="group-hover:text-gray-700 capitalize">Staff Posyandu</span>
                </NavLink>
            </li>
            <li>
                <NavLink :href="route('OrangTua.index')" :active="route().current('OrangTua.index')" :icon="['fas','users-line']">

                    <span class="group-hover:text-gray-700 capitalize">Orang Tua</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#" :icon="['far', 'calendar-days']">
                    <span class="group-hover:text-gray-700 capitalize">Jadwal Imunisasi</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#" :icon="['fas','chart-pie']">
                    <span class="group-hover:text-gray-700 capitalize">Data Balita Dan Ibu Hamil</span>
                </NavLink>
            </li>
            <li>
                <NavLink href="#" :icon="['fas','gears']">
                    <span class="group-hover:text-gray-700 capitalize">setting</span>
                </NavLink>
            </li>
        </ul>
    </div>
    <div class="-mx-6 flex items-center justify-between border-t px-6 pt-4">
        <NavLink :href="route('logout')" method="post" as="button" :icon="['fas','right-from-bracket']">
            <span class="group-hover:text-gray-700 capitalize">Logout</span>
        </NavLink>
    </div>
</template>
