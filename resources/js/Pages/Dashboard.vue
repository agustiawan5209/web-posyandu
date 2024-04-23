<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChartPertumbuhanPengguna from '@/Components/Chart/ChartPertumbuhanPengguna.vue';
import CardCalendar from '@/Components/Card/CardCalendar.vue';
import ChartJumlah from '@/Components/Chart/ChartJumlah.vue';
import HeaderStats from '@/Components/Header/HeaderStats.vue';
import { defineProps } from "vue";

const props = defineProps({
    pengguna: Number,
    balita: Number,

});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-4 relative box-content">
            <div class="max-w-7xl mx-auto sm:px-6">
                <HeaderStats :pengguna="pengguna" :balita="balita" />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col md:flex-row gap-7 p-2">
                        <div class="relative w-full md:w-[50%]">
                            <h3 class=" text-xs md:text-base lg:text-lg font-semibold text-center">Kalender Jadwal Imunisasi</h3>
                            <CardCalendar />
                        </div>
                        <div class="relative border w-full md:w-[50%] flex justify-center">
                            <ChartJumlah />

                        </div>
                    </div>
                    <div class="relative w-full">
                        <ChartPertumbuhanPengguna />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
